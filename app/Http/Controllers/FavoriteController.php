<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Services\FavoriteService;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function favoriteHandling(Place $place)
    {

        return app(FavoriteService::class)->favoriteHandle($place);
    }
}
