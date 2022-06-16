<?php

namespace App\Services;

use App\Models\Place;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LikeService
{

    public function getLikedPlacesId()
    {
        $likedPlacesId = [];
        $data = Auth::check()
            ?
            DB::table('likes')
                ->where('user_id', Auth::user()->getAuthIdentifier())
                ->get()
                ->toArray()
            :
            DB::table('likes')
                ->where('session_token', session()->get('_token'))
                ->get()
                ->toArray();
        foreach ($data as $key => $value) {
            $likedPlacesId[] = $value->place_id;
        }
        return $likedPlacesId;
    }

    public function likeHandle(Place $place)
    {
        try {
            if (Auth::check()) {
                $like = DB::table('likes')
                    ->where('place_id', '=', $place->id)
                    ->where('user_id', '=', Auth::user()->getAuthIdentifier());
            } else {
                $like = DB::table('likes')
                    ->where('place_id', '=', $place->id)
                    ->where('session_token', '=', session()->get('_token'));
            }
            if ($like->exists()) {
                $like->delete();
                $response = [
                    'state' => 'like',
                ];
            } else {
                DB::table('likes')->insert([
                    'place_id' => $place->id,
                    'user_id' => Auth::user()->id ?? 1,
                    'session_token' => session()->get('_token'),
                ]);
                $response = [
                    'state' => 'dislike',
                ];
            }
            $response['total'] = $place->likes->count();
            return response()->json($response);

        } catch (\Exception $e) {
            return response()->json('error', 400);
        }

    }

}
