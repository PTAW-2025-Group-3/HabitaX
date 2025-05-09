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

        // Query base
        $query = Advertisement::where('state', 'active')
            ->with('property')
            ->select('advertisements.*');

        // Aplicar filtros (assumindo que o AdvertisementFilterRequest já os aplica corretamente)
        $query = $request->applyFilters($query);

        // Carregamento de dados auxiliares para os selects
        $propertyTypes = PropertyType::where('is_active', true)->orderBy('id')->get();
        $districts = District::with('municipalities.parishes')->orderBy('name')->get();

        // Resultado final paginado
        $advertisements = $query->paginate(9);

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
            'transactionType'
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
            ->with('advertisement.property.parish.municipality')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('advertisements.favorites', compact('favorites'));
    }


    public function show($id)
    {
        $ad = Advertisement::find($id);
        $property = Property::find($ad->property_id);

        if (!$ad || !$property) {
            return redirect()->route('advertisements.index')->with('error', 'Anúncio não encontrado.');
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
            'priceHistory' => $priceHistory,
        ]);
    }

    public function help()
    {
        return view('advertisements.help');
    }
}
