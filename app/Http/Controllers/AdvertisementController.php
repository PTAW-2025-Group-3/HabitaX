<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdvertisementFilterRequest;
use App\Models\Advertisement;
use App\Models\DenunciationReason;
use App\Models\FavoriteAdvertisement;
use App\Models\PriceHistory;
use App\Models\Property;
use App\Models\PropertyParameter;
use App\Models\PropertyType;
use App\Models\District;
use App\Models\SearchFilter;
use App\Traits\MonthsInPortuguese;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdvertisementController extends Controller
{
    use MonthsInPortuguese;
    public function search(Request $request)
    {
        $districts = District::with('municipalities.parishes')->orderBy('name')->get();

        return view('advertisements.search', compact('districts'));
    }

    public function index(AdvertisementFilterRequest $request)
    {
        // Filtros selecionados vindos da query string
        $selectedDistrict = $request->input('district');
        $selectedMunicipality = $request->input('municipality');
        $selectedParish = $request->input('parish');
        $selectedType = $request->input('property_type');
        $transactionType = $request->input('transaction_type');

        $viewMode = $request->input('view', 'grid'); // 'grid' por defeito
        $perPage = $viewMode === 'list' ? 10 : 28;

        // Query base
        $query = Advertisement::where('is_published', true)
            ->where('is_suspended', false)
            ->whereHas('property.property_type', function ($q) {
                $q->where('is_active', true);
            });

        // Eager load condicional
        if ($viewMode === 'list') {
            $query->with('property.parameters.attribute');
        } else {
            $query->with('property');
        }

        // Aplicar filtros adicionais
        $query = $request->applyFilters($query);

        $advertisements = $query->paginate($perPage);

        // Dados auxiliares
        $propertyTypes = PropertyType::where('is_active', true)->orderBy('id')->get();
        $districts = District::where('is_active', true)->orderBy('name')->get();

        $savedSearches = SearchFilter::where('created_by', auth()->id())
            ->with('propertyType')
            ->orderBy('created_at', 'desc')
            ->get();

        if ($request->ajax()) {
            return view('advertisements.listing.advertisement-listings', compact('advertisements'))->render();
        }

        return view('advertisements.index', compact(
            'advertisements',
            'propertyTypes',
            'districts',
            'selectedDistrict',
            'selectedMunicipality',
            'selectedParish',
            'selectedType',
            'transactionType',
            'viewMode',
            'savedSearches'
        ));
    }

    public function my(Request $request)
    {
        $state = $request->input('state_filter', 'all');

        $query = auth()->user()->advertisements()->with('property');

        if ($state === 'published') {
            $query->where('is_published', true)
                ->where('is_suspended', false);
        } elseif ($state === 'pending') {
            $query->where('is_published', false)
                ->where('is_suspended', false);
        } elseif ($state === 'suspended') {
            $query->where('is_suspended', true);
        } else {
            $query->where('is_suspended', false);
        }

        // Filtrar para mostrar apenas anúncios com tipos de propriedade ativos
        $query->whereHas('property.property_type', function($q) {
            $q->where('is_active', true);
        });

        $ads = $query->orderBy('updated_at', 'desc')->paginate(9);

        if ($request->ajax()) {
            return view('advertisements.listing.advertisement-listings', compact('ads'))->render();
        }

        return view('advertisements.my', compact('ads'));
    }

    public function favorites()
    {
        return redirect()->route('favorites.index');
    }

    public function show($id)
    {
        $ad = Advertisement::with([
            'property.parish.municipality',
            'creator',
            'favorites.user'
        ])->withCount([
            'favorites',  // Adiciona a contagem de favoritos
            'requests'    // Adiciona a contagem de pedidos de contacto
        ])->findOrFail($id);

        if (!$ad) {
            return redirect()->route('advertisements.index')->with('error', 'Anúncio não encontrado.');
        }

        // Verifica se o anúncio está publicado
        if (!$ad->is_published) {
            // Se não estiver publicado, apenas o criador pode ver
            if (!auth()->check() ||
                (auth()->id() !== $ad->created_by &&
                    !auth()->user()->isAdmin() &&
                    !auth()->user()->isModerator())) {
                return redirect()->route('advertisements.index')
                    ->with('error', 'Este anúncio não está disponível para visualização.');
            }
        }

        // Verifica se o anúncio está suspenso - bloqueando acesso para todos exceto admin/moderador
        if ($ad->is_suspended) {
            if (!auth()->check() || (!auth()->user()->isAdmin() && !auth()->user()->isModerator())) {
                return redirect()->route('advertisements.index')
                    ->with('error', 'Este anúncio não está mais disponível.');
            }
        }

        // Verifica se o criador do anúncio está suspenso/banido/arquivado
        if (in_array($ad->creator->state, ['suspended', 'banned', 'archived'])) {
            // Apenas admins e moderadores podem acessar anúncios de utilizadores suspensos
            if (!auth()->check() || (!auth()->user()->isAdmin() && !auth()->user()->isModerator())) {
                return redirect()->route('advertisements.index')
                    ->with('error', 'Este anúncio não está mais disponível.');
            }
        }

        $property = Property::find($ad->property_id);

        if (!$property) {
            return redirect()->route('advertisements.index')->with('error', 'Propriedade não encontrada.');
        }

        $attributes = $property->property_type->attributes()
            ->with('groups')
            ->get();

        $groups = $attributes->pluck('groups')->flatten()->keyBy('id');

        $parameters = PropertyParameter::where('property_id', $property->id)
            ->with('attribute')
            ->get()
            ->filter(function ($param) {
                return !is_null(
                    $param->text_value ?? $param->int_value ?? $param->float_value ?? $param->boolean_value ?? $param->select_value ?? $param->date_value ?? $param->value
                );
            });

        // group parameters by PropertyAttributeGroup depending on if attribute makes part of a group
        $groupedParameters = [];
        foreach ($parameters as $parameter) {
            $groupId = $parameter->attribute->groups->first()->id ?? null;
            if ($groupId) {
                $groupedParameters[$groupId][] = $parameter;
            } else {
                $groupedParameters['no_group'][] = $parameter;
            }
        }

        $priceHistory = PriceHistory::where('advertisement_id', $ad->id)
            ->orderBy('register_date', 'asc')
            ->get();

        // Adiciona flag para mostrar alerta quando estiver vendo um anúncio não publicado
        $showUnpublishedAlert = !$ad->is_published;

        $ptMonths = $this->getPortugueseMonths();

        $formattedDates = $priceHistory->map(function ($item) {
            return $item->register_date->format('d/m/Y');
        });

        // Obter a média de preço do distrito com base no tipo de transação e tipo de propriedade
        $districtId = $ad->property->parish->municipality->district_id ?? null;
        $propertyTypeId = $ad->property->property_type_id ?? null;

        if ($districtId && $propertyTypeId) {
            // Calcular a média de preços no distrito para o mesmo tipo de transação e tipo de propriedade
            $districtAverage = Advertisement::where('is_published', true)
                ->where('is_suspended', false)
                ->where('transaction_type', $ad->transaction_type)
                ->whereHas('property', function($query) use ($propertyTypeId) {
                    $query->where('property_type_id', $propertyTypeId);
                })
                ->whereHas('property.parish.municipality', function($query) use ($districtId) {
                    $query->where('district_id', $districtId);
                })
                ->whereHas('property.property_type', function($q) {
                    $q->where('is_active', true);
                })
                ->whereHas('creator', function($q) {
                    $q->whereNotIn('state', ['suspended', 'banned', 'archived']);
                })
                ->avg('price');

            $ad->district_average = $districtAverage;
        } else {
            $ad->district_average = 0;
        }

        return view('advertisements.show', [
            'ad' => $ad,
            'property' => $property,
            'attributes' => $attributes,
            'groups' => $groups,
            'parameters' => $parameters,
            'groupedParameters' => $groupedParameters,
            'priceHistory' => $priceHistory,
            'showUnpublishedAlert' => $showUnpublishedAlert,
            'ptMonths' => $ptMonths,
            'formattedDates' => $formattedDates,
        ]);

    }

    public function help()
    {
        return view('advertisements.help');
    }

    public function create()
    {
        $user = auth()->user();

        $properties = $user->properties()->orderBy('created_at', 'desc')->get();

        return view('advertisements.create', [
            'properties' => $properties,
            'advertisement' => null,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'transaction_type' => 'required|in:sale,rent',
            'property_id' => 'required|exists:properties,id',
            'is_published' => 'nullable|boolean',
        ]);

        $advertisement = new Advertisement($validated);
        $advertisement->reference = fake()->unique()->numberBetween(100000, 999999);
        $advertisement->is_published = $request->has('is_published');
        $advertisement->is_suspended = false;
        $advertisement->created_by = auth()->id();
        $advertisement->save();

        return redirect()->route('advertisements.my')
            ->with('success', 'Anúncio criado com sucesso!');
    }

    public function update(Request $request, $id)
    {
        $advertisement = Advertisement::findOrFail($id);

        if (auth()->id() !== $advertisement->created_by) {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'transaction_type' => 'required|in:sale,rent',
            'property_id' => 'required|exists:properties,id',
            'is_published' => 'nullable|boolean',
        ]);

        $validated['is_published'] = $request->has('is_published');
        $advertisement->update($validated);

        return redirect()->route('advertisements.my')
            ->with('success', 'Anúncio atualizado com sucesso!');
    }

    public function edit($id)
    {
        $advertisement = Advertisement::with('creator')->findOrFail($id);

        if (auth()->id() !== $advertisement->creator->id) {
            abort(403, 'Unauthorized');
        }

        $properties = auth()->user()->properties;

        return view('advertisements.edit', compact('advertisement', 'properties'));
    }

    public function destroy($id)
    {
        $advertisement = Advertisement::with('creator')->findOrFail($id);

        if (auth()->id() !== $advertisement->creator->id) {
            abort(403, 'Unauthorized');
        }

        $advertisement->delete();

        return redirect()->route('advertisements.my')->with('success', 'O anúncio foi removido com sucesso!');
    }

}
