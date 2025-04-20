<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\FavoriteAdvertisement;
use App\Models\PriceHistory;
use App\Models\Property;
use App\Models\PropertyAttribute;
use App\Models\PropertyParameter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdvertisementController extends Controller
{
    public function index(Request $request)
    {
        $query = Advertisement::with(['property'])
            ->where('state', 'active')
            ->join('properties', 'advertisements.property_id', '=', 'properties.id')
            ->select('advertisements.*');

        // Filtro por localização
        if ($request->filled('location')) {
            $query->where('location', 'LIKE', "%{$request->location}%");
        }

        // Filtro por tempo de publicação
        if ($request->filled('time_period')) {
            $timePeriod = $request->time_period;
            $now = now();

            if ($timePeriod === '24h') {
                $query->where('advertisements.created_at', '>=', $now->subDay());
            } elseif ($timePeriod === '3d') {
                $query->where('advertisements.created_at', '>=', $now->subDays(3));
            } elseif ($timePeriod === '7d') {
                $query->where('advertisements.created_at', '>=', $now->subDays(7));
            } elseif ($timePeriod === '30d') {
                $query->where('advertisements.created_at', '>=', $now->subDays(30));
            }
        }

        // Filtro por preço
        if ($request->filled('min_price') && is_numeric($request->min_price)) {
            $query->where('price', '>=', (float)$request->min_price);
        }
        if ($request->filled('max_price') && is_numeric($request->max_price)) {
            $query->where('price', '<=', (float)$request->max_price);
        }

        // Filtro por tamanho (área total)
        if ($request->filled('min_area') && is_numeric($request->min_area)) {
            $query->where('properties.total_area', '>=', (float)$request->min_area);
        }
        if ($request->filled('max_area') && is_numeric($request->max_area)) {
            $query->where('properties.total_area', '<=', (float)$request->max_area);
        }

        // Ordenação
        switch ($request->input('sort', 'recent')) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            default: // 'recent' ou padrão
                $query->orderBy('created_at', 'desc');
                break;
        }

        $advertisements = $query->paginate(10);

        if ($request->ajax()) {
            return view('pages.advertisements.listing.property-listings', compact('advertisements'))->render();
        }

        return view('pages.advertisements.index', compact('advertisements'));
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

    public function favorites()
    {
        $user = auth()->user();
        $favorites = FavoriteAdvertisement::where('user_id', $user->id)
            ->with(['advertisement.property'])
            ->orderBy('created_at', 'desc')
            ->get();
        return view('pages.advertisements.favorites', compact('favorites'));
    }

    public function show($id)
    {
        $ad = Advertisement::find($id);
        $property = Property::find($ad->property_id);
        if (!$ad || !$property) {
            return redirect()->route('advertisements.index')->with('error', 'Anúncio não encontrado.');
        }
        $attributes = PropertyParameter::where('property_id', $property->id)
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
