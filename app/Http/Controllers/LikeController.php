<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LikeController extends Controller
{
    public function likeHandle(int $place_id)
    {
        try {
            DB::table('likes')->insert([
                    'place_id' => $place_id,
//                    пока ставлю, что лайкает только пользователь 1
//                    'user_id' => 1,
                ]);
            $likes = DB::table('likes')
                ->where('place_id', $place_id)
                ->get()
                ->count();

            return response()->json($likes);

        }catch(\Exception $e){
            return response()->json('error', 400);
        }

    }

}
