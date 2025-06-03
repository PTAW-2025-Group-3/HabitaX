<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\FavoriteAdvertisement;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function toggle(Request $request, Advertisement $advertisement)
    {
        $user = auth()->user();
        $favorite = FavoriteAdvertisement::where([
            'user_id' => $user->id,
            'advertisement_id' => $advertisement->id
        ])->first();

        if ($favorite) {
            $favorite->delete();
            $isFavorite = false;
        } else {
            FavoriteAdvertisement::create([
                'user_id' => $user->id,
                'advertisement_id' => $advertisement->id
            ]);
            $isFavorite = true;
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'isFavorite' => $isFavorite
            ]);
        }

        return back();
    }

    public function index(Request $request)
    {
        $user = auth()->user();
        $sort = $request->get('sort', 'date_desc');

        $query = FavoriteAdvertisement::where('favorite_advertisements.user_id', $user->id) // Qualificando com nome da tabela
        ->whereHas('advertisement', function($query) {
            $query->where('is_suspended', false)
                ->where('is_published', true)
                ->whereHas('creator', function($q) {
                    $q->where('state', 'active');
                })
                ->whereHas('property.property_type', function($q) {
                    $q->where('is_active', true);
                });
        })
            ->with('advertisement.property.parish.municipality');

        // Aplicar ordenação baseada no parâmetro sort
        switch ($sort) {
            case 'price_asc':
                $query->join('advertisements', 'favorite_advertisements.advertisement_id', '=', 'advertisements.id')
                    ->select('favorite_advertisements.*')
                    ->orderBy('advertisements.price', 'asc');
                break;
            case 'price_desc':
                $query->join('advertisements', 'favorite_advertisements.advertisement_id', '=', 'advertisements.id')
                    ->select('favorite_advertisements.*')
                    ->orderBy('advertisements.price', 'desc');
                break;
            case 'date_asc':
                $query->orderBy('favorite_advertisements.created_at', 'asc');
                break;
            case 'date_desc':
            default:
                $query->orderBy('favorite_advertisements.created_at', 'desc');
                break;
        }

        $favorites = $query->paginate(9);

        return view('advertisements.favorites', compact('favorites', 'sort'));
    }

    public function destroy($id)
    {
        $favorite = FavoriteAdvertisement::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $favorite->delete();

        if (request()->ajax()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('favorites.index')->with('success', 'Favorite removed successfully.');
    }

}
