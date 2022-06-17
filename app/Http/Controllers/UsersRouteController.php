<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Place;
use App\Models\Route;
use App\Services\FavoriteService;
use App\Services\LikeService;
use App\Services\UserRoutesService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UsersRouteController extends Controller
{
    private UserRoutesService $userRoutes;

    public function __construct(UserRoutesService $userRoutes)
    {
        $this->userRoutes = $userRoutes;
    }

    public function routeHandling(Place $place): JsonResponse
    {
        return $this->userRoutes->routeHandle($place);
    }

    public function showRoutes()
    {
        $places = Place::query()
            ->join('routes', 'routes.place_id', '=', 'places.id')
            ->where('user_id', Auth::user()->getAuthIdentifier())
            ->get('places.*');

        $places2 = Route::query()
            ->where('user_id', Auth::user()->getAuthIdentifier())
            ->get();

        return view('account.routes', [
            'journeys'=> $places,
            'images' => Image::all()
        ]);


    }

}
