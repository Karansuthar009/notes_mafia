<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;

class FavorateController extends Controller
{
    public function addFavorite(Request $request)
    {
        $user = Auth()->user();
        $fileId = $request->input('id');

        $exists = Favorite::where('user_id', $user->id)
                          ->where('file_id', $fileId)
                          ->exists();

        if (!$exists) {

            Favorite::create([
                'file_id' => $fileId,
                'user_id' => $user->id,
                'status' =>  'favorite'
            ]);

            return response()->json(['message' => 'Favorite added'], 200);
        }
        return response()->json(['message' => 'Already favorited'], 400);
    }

    public function removeFavorite(Request $request)
    {
        $user = Auth()->user();
        $fileId = $request->input('id');

        Favorite::where('user_id', $user->id)
                ->where('file_id', $fileId)
                ->delete();

        return response()->json(['message' => 'Favorite removed'], 200);
    }

}
