<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LikeController extends Controller
{
    public function likeHandle(string $like, int $place_id)
    {
        if ($like == 'like') {
            try {
                DB::table('likes')->insert([
                    'place_id' => $place_id,
//                    пока ставлю, что лайкает только пользователь 1
                    'user_id' => 1,
                ]);
                $likes = DB::table('likes')
                    ->where('place_id', $place_id)
                    ->get()
                    ->count();
            } catch (\Exception $e) {
                return response()->json('error', 400);
            }
        } else if ($like == 'dislike') {
            try {
                DB::table('likes')->
                where([
                    ['place_id', '=', $place_id],
                    ['user_id', '=', 1],
                ])
                    ->limit(1)
                    ->delete();

                $likes = DB::table('likes')
                    ->where('place_id', $place_id)
                    ->get()
                    ->count();
            } catch
            (\Exception $e) {
                return response()->json('error', 400);
            }
        }

        return response()->json($likes);


    }

}
