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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdvertisementController extends Controller
{
    public function index(AdvertisementFilterRequest $request)
    {
        // Filtros selecionados vindos da query string
        $selectedDistrict = $request->input('district');
        $selectedMunicipality = $request->input('municipality');
        $selectedParish = $request->input('parish');
        $selectedType = $request->input('property_type');
        $transactionType = $request->input('transaction_type');

        // Query base - usando os novos campos
        $query = Advertisement::where('is_published', true)
            ->where('is_suspended', false)
            ->whereHas('creator', function($q) {
                $q->where('state', 'active');
            })
            ->whereHas('property.property_type', function($q) {
                $q->where('is_active', true);
            })
            ->with('property.parameters.attribute')
            ->select('advertisements.*');

        // Aplicar filtros (assumindo que o AdvertisementFilterRequest já os aplica corretamente)
        $query = $request->applyFilters($query);

        // Carregamento de dados auxiliares para os selects
        $propertyTypes = PropertyType::where('is_active', true)->orderBy('id')->get();
        $districts = District::with('municipalities.parishes')->orderBy('name')->get();

        $viewMode = $request->input('view', 'grid'); // 'grid' por defeito
        $perPage = $viewMode === 'list' ? 10 : 21;

        $advertisements = $query->paginate($perPage);

        if ($request->ajax()) {
            return view('advertisements.listing.advertisement-listings', compact('advertisements'))->render();
        }

        // Passar também os filtros selecionados para o blade
        return view('advertisements.index', compact(
            'advertisements',
            'propertyTypes',
            'districts',
            'selectedDistrict',
            'selectedMunicipality',
            'selectedParish',
            'selectedType',
            'transactionType',
            'viewMode'
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
        }

        $ads = $query->orderBy('updated_at', 'desc')->paginate(9);

        if ($request->ajax()) {
            return view('advertisements.listing.advertisement-listings', compact('ads'))->render();
        }

        return view('advertisements.my', compact('ads'));
    }

    public function favorites()
    {
        $user = auth()->user();
        $favorites = FavoriteAdvertisement::where('user_id', $user->id)
            ->whereHas('advertisement', function($query) {
                $query->where('is_suspended', false)
                    ->whereHas('creator', function($q) {
                        $q->where('state', 'active');
                    })
                    ->whereHas('property.property_type', function($q) {
                        $q->where('is_active', true);
                    });
            })
            ->with('advertisement.property.parish.municipality')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('advertisements.favorites', compact('favorites'));
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
            ->get();

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

        return view('advertisements.show', [
            'ad' => $ad,
            'property' => $property,
            'attributes' => $attributes,
            'groups' => $groups,
            'parameters' => $parameters,
            'groupedParameters' => $groupedParameters,
            'priceHistory' => $priceHistory,
            'showUnpublishedAlert' => $showUnpublishedAlert
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

        return redirect()->route('advertisements.my')->with('success', 'Anúncio deletado com sucesso!');
    }

}
