<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Image;
use App\Models\Place;
use App\Models\Transport;
use App\Models\User;
use App\Services\FavoriteService;
use App\Services\LikeService;
use App\Services\UserRoutesService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;

class JourneyController extends Controller
{
    public function getJourneysWithFilters(Request $request): Factory|View|Application
    {
        // Определяем фильтры из запроса
        $filters = [
            'city' => $request->input('city'), // город
            'transport' => $request->input('transport'), // вид транспорта
            'complexity' => $request->input('complexity'), // сложность
            'minDistance' => $request->input('minDistance'), //.. и т.д.
            'maxDistance' => $request->input('maxDistance'),
            'minCost' => $request->input('minCost'),
            'maxCost' => $request->input('maxCost'),
            'search' => $request->input('search'),
        ];

        // Получаем места по 15 штук на заданной странице
        $page = Paginator::resolveCurrentPage() ?: 1;
        $itemsPerPage = 9;
        $places = Place::getWhithFiltersOnPage($page, $itemsPerPage, $filters)->withPath('/journeys');

        return view('trips', [
            'images' => Image::all(),
            'journeys' => $places,
            'cities' => City::all()->reject(function ($city) {
                return $city->places->count() === 0;
            }),
            'transports' => Transport::all()->reject(function ($transport) {
                return $transport->places->count() === 0;
            }),
            'likes' => app(LikeService::class)->getLikedPlacesId(),
            'message' => $places->count() == 0 ? 'Путешествий не найдено' : '',
            'favorites' => app(FavoriteService::class)->getFavoritePlacesId(),
            'routes' => app(UserRoutesService::class)->getSelectedPlaces(),
        ]);
    }

    public function show(Place $place): Factory|View|Application
    {
        return view('place', [
            'place' => $place,
            'likes' => app(LikeService::class)->getLikedPlacesId(),
            'favorites' => app(FavoriteService::class)->getFavoritePlacesId(),
            'routes' => app(UserRoutesService::class)->getSelectedPlaces(),
            'pageTitle' => Str::ucfirst($place->title),
        ]);
    }

    public function index(string $title, string $user_slug): Factory|View|Application
    {

        $user = User::where('slug', $user_slug)->firstOrFail();

        switch ($title) {
            case 'liked':
                $places = Place::query()
                    ->join('likes', 'likes.place_id', '=', 'places.id')
                    ->where('user_id', $user->id)
                    ->get('places.*');
                $type = 'любимые';

                break;
            case 'favorite':
                $places = Place::query()
                    ->join('favorites', 'favorites.place_id', '=', 'places.id')
                    ->where('user_id', $user->id)
                    ->get('places.*');
                $type = 'избранные';
                break;
            case 'created':
                $places = Place::query()
                    ->where('created_by_user_id', $user->id)
                    ->get();
                $type = 'созданные';
                break;
        }

        return view('places.index', [
            'user' => $user,
            'journeys' => $places,
            'likes' => app(LikeService::class)->getLikedPlacesId(),
            'favorites' => app(FavoriteService::class)->getFavoritePlacesId(),
            'title' => $type,
            'routes' => []
        ]);
    }
}
