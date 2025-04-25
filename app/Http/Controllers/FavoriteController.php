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

    public function index()
    {
        $favorites = FavoriteAdvertisement::with('advertisement.property.parish.municipality')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('advertisements.favorites', compact('favorites'));
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
