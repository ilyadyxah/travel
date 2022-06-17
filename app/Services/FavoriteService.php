<?php

namespace App\Services;

use App\Models\Place;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FavoriteService
{

    public function favoriteHandle(Place $place)
    {
        try {
            $favorite = DB::table('favorites')
                ->where('place_id', '=', $place->id)
                ->where('user_id', '=', Auth::user()->getAuthIdentifier());

            if ($favorite->exists()){
                $favorite->delete();
                $response = [
                    'state' => 'false',
                ];
            } else{
                DB::table('favorites')->insert([
                    'place_id' => $place->id,
                    'user_id' => Auth::user()->getAuthIdentifier(),
                ]);

                $response = [
                    'state' => 'true',
                ];
            }
            return response()->json($response);

        }catch(\Exception $e){
            return response()->json('error', 400);
        }

    }

    public function getFavoritePlacesId()
    {
        $favoritePlacesId = [];
        if (Auth::check()){
            $data = DB::table('favorites')
                ->where('user_id', Auth::user()->getAuthIdentifier())
                ->get()->toArray();
            foreach ($data as $key => $value){
                $favoritePlacesId[] = $value->place_id;
            }
        }
        return $favoritePlacesId;
    }

    public function getFavoritePlacesIdByUser(User $user)
    {
        $favoritePlacesId = [];

            $data = DB::table('favorites')
                ->where('user_id',$user->id )
                ->get();
            foreach ($data as $key => $value){
                $favoritePlacesId[] = $value->place_id;
            }
        return $favoritePlacesId;
    }

}
