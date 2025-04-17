<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\PriceHistory;
use App\Models\Property;
use App\Models\PropertyAttribute;
use App\Models\PropertyValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdvertisementController extends Controller
{
    public function index(Request $request)
    {
        $location = $request->input('location');
        $advertisements = Advertisement::where('state', 'active')
            ->when($location, function ($query) use ($location) {
                return $query->where('location', 'LIKE', "%{$location}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        if ($request->ajax()) {
            return view('pages.advertisements.listing.property-listings', compact('advertisements'))->render();
        }
        return view('pages.advertisements.index', compact('advertisements', 'location'));
    }

    public function my(Request $request)
    {
        $ads = Advertisement::where('created_by', auth()->user()->getKey())
            ->with('property')
            ->orderBy('created_at', 'desc')
            ->get();

        if ($request->ajax()) {
            return view('pages.advertisements.listing.property-listings', compact('ads'))->render();
        }
        return view('pages.advertisements.my', compact('ads'));
    }

    public function show($id)
    {
        $ad = Advertisement::find($id);
        $property = Property::find($ad->property_id);
        if (!$ad || !$property) {
            return redirect()->route('advertisements.index')->with('error', 'Anúncio não encontrado.');
        }
        $attributes = PropertyValue::where('property_id', $property->id)
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

        return view('pages.advertisements.show', [
            'ad' => $ad, 'property' => $property,
            'attributes' => $attributes, 'price_history' => $price_history
        ]);
    }
}
