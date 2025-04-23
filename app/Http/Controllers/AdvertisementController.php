<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdvertisementFilterRequest;
use App\Models\Advertisement;
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
        $advertisements = $query->paginate(10);

        if ($request->ajax()) {
            return view('advertisements.listing.property-listings', compact('advertisements'))->render();
        }

        // Passar também os filtros selecionados para o blade
        return view('advertisements.index', compact(
            'advertisements',
            'propertyTypes',
            'districts',
            'selectedDistrict',
            'selectedMunicipality',
            'selectedParish',
            'selectedType'
        ));
    }

    public function my(Request $request)
    {
        $ads = auth()->user()->advertisements()
            ->with('property')
            ->orderBy('created_at', 'desc')
            ->get();

        if ($request->ajax()) {
            return view('advertisements.listing.property-listings', compact('ads'))->render();
        }

        return view('advertisements.my', compact('ads'));
    }

    public function favorites()
    {
        $user = auth()->user();
        $favorites = FavoriteAdvertisement::where('user_id', $user->id)
            ->with(['advertisement.property'])
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($favorite) {
                return $favorite->advertisement;
            });

        return view('advertisements.favorites', compact('favorites'));
    }

    public function show($id)
    {
        $ad = Advertisement::find($id);
        $property = Property::find($ad->property_id);

        if (!$ad || !$property) {
            return redirect()->route('advertisements.index')->with('error', 'Anúncio não encontrado.');
        }

        $parameters = PropertyParameter::where('property_id', $property->id)
            ->with('attribute')
            ->get()
            ->map(function ($item) {
                return [
                    'name' => $item->attribute->name,
                    'value' => $item->value,
                ];
            })
            ->toArray();

        $priceHistory = PriceHistory::where('advertisement_id', $ad->id)
            ->orderBy('register_date', 'asc')
            ->get();

        return view('advertisements.show', [
            'ad' => $ad,
            'property' => $property,
            'attributes' => $parameters,
            'priceHistory' => $priceHistory
        ]);
    }

    public function showSearchFields()
    {
        $propertyTypes = PropertyType::where('is_active', true)->orderBy('id')->get();

        return view('advertisements.listing.search-fields', compact('propertyTypes'));
    }

    public function help()
    {
        return view('advertisements.help');
    }
}
