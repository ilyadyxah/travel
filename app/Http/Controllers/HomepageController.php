<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Place;
use App\Models\Transport;
use App\Models\User;
use App\Services\FavoriteService;
use App\Services\LikeService;
use App\Services\UserRoutesService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory as FactoryAlias;
use Illuminate\Contracts\View\View;

class HomepageController extends Controller
{
    private UserRoutesService $userRoutes;

    public function __construct(UserRoutesService $userRoutes)
    {
        $this->userRoutes = $userRoutes;
    }

    public function index(): FactoryAlias|View|Application
    {
        User::query()->first();

        return view('home', [
            'journeys' => Place::orderBy('updated_at', 'desc')->paginate(6),

            'cities' => City::all()->reject(function ($city) {
                return $city->places->count() === 0;
            }),
            'transports' => Transport::all()->reject(function ($transport) {
                return $transport->places->count() === 0;
            }),
            'likes' => app(LikeService::class)->getLikedPlacesId(),
            'favorites' => app(FavoriteService::class)->getFavoritePlacesId(),
            'routes' => $this->userRoutes->getSelectedPlaces(),
        ]);
    }
}
