<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdvertisementFilterRequest;
use App\Models\Advertisement;
use App\Models\FavoriteAdvertisement;
use App\Models\PriceHistory;
use App\Models\Property;
use App\Models\PropertyParameter;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    public function index(AdvertisementFilterRequest $request)
    {
        $query = Advertisement::where('state', 'active')
            ->with('property')
            ->select('advertisements.*');

        $query = $request->applyFilters($query);

        $advertisements = $query->paginate(10);

        if ($request->ajax()) {
            return view('advertisements.listing.property-listings', compact('advertisements'))->render();
        }

        return view('advertisements.index', compact('advertisements'));
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
        $price_history = PriceHistory::where('advertisement_id', $ad->id)
            ->orderBy('register_date', 'desc')
            ->limit(5)
            ->get()
            ->map(function ($item) {
                return [
                    'price' => $item->price,
                    'date' => $item->register_date->format('d/m/Y'),
                ];
            })
            ->toArray();

        return view('advertisements.show', [
            'ad' => $ad, 'property' => $property,
            'attributes' => $parameters, 'price_history' => $price_history
        ]);
    }

    public function help()
    {
        return view('advertisements.help');
    }
}
