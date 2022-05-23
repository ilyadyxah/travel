<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Services\LikeService;

class LikeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Place $product
     * @return \Illuminate\Http\Response
     */
    public function likeHandling(Place $place)
    {
        return app(LikeService::class)->likeHandle($place);
    }

    public function placeLikeCount(Place $place)
    {
        try {
            $response['count'] = $place->likes->count();;
            return response()->json($response);
        } catch (\Exception $e) {
            return response()->json('error', 400);
        }
    }

}
