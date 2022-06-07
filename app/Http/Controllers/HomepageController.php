<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Image;
use App\Models\Place;
use App\Models\Transport;
use App\Services\FavoriteService;
use App\Services\LikeService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory as FactoryAlias;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return Application|FactoryAlias|View
     */
    public function index()
    {

        return view('home', [
            'journeys' => Place::all(),
            'images' => Image::all(),
            'cities' => City::all()->reject(function ($city) {
                return $city->places->count() === 0;
            }),
            'transports' => Transport::all()->reject(function ($transport) {
                return $transport->places->count() === 0;
            }),
            'likes' => app(LikeService::class)->getLikedPlacesId(),
            'favorites' => app(FavoriteService::class)->getFavoritePlacesId()
        ]);
    }
}
