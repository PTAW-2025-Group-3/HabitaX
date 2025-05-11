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
            ->with('property.parameters.attribute')
            ->select('advertisements.*');

        Log::debug('Request attributes:', $request->input('attributes', []));

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
        $ads = auth()->user()->advertisements()
            ->with('property')
            ->orderBy('created_at', 'desc')
            ->get();

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
                    });
            })
            ->with('advertisement.property.parish.municipality')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('advertisements.favorites', compact('favorites'));
    }

    public function show($id)
    {
        $ad = Advertisement::find($id);

        if (!$ad) {
            return redirect()->route('advertisements.index')->with('error', 'Anúncio não encontrado.');
        }

        // Verifica se o anúncio está suspenso - bloqueando acesso para todos
        if ($ad->is_suspended) {
            return redirect()->route('advertisements.index')
                ->with('error', 'Este anúncio não está mais disponível.');
        }

        // Verifica se o criador do anúncio está suspenso/banido/arquivado
        if (in_array($ad->creator->state, ['suspended', 'banned', 'archived'])) {
            // Apenas admins e moderadores podem acessar anúncios de usuários suspensos
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

        return view('advertisements.show', [
            'ad' => $ad,
            'property' => $property,
            'attributes' => $attributes,
            'groups' => $groups,
            'parameters' => $parameters,
            'groupedParameters' => $groupedParameters,
            'priceHistory' => $priceHistory
        ]);
    }

    public function help()
    {
        return view('advertisements.help');
    }
}
