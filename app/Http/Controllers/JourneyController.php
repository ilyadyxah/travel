<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Comment;
use App\Models\Image;
use App\Models\Like;
use App\Models\Place;
use App\Models\Transport;
use App\Models\User;
use App\Services\FavoriteService;
use App\Services\LikeService;
use App\Services\UserRoutesService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Request;

class JourneyController extends Controller
{
    public function getJourneysWithFilters(Request $request, $page = 1)
    {
        // Определяем фильтры из запроса
        $filters = [
            'city' => $request->city, // город
            'transport' => $request->transport, // вид транспорта
            'complexity' => $request->complexity, // сложность
            'minDistance' => $request->minDistance, //.. и т.д.
            'maxDistance' => $request->maxDistance,
            'minCost' => $request->minCost,
            'maxCost' => $request->maxCost,
            'search' => $request->search,
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
            'favorites' => app(FavoriteService::class)->getFavoritePlacesId()
        ]);
    }

    public function show(Place $place)
    {
        return view('place', [
            'place' => $place,
            'likes' => app(LikeService::class)->getLikedPlacesId(),
            'favorites' => app(FavoriteService::class)->getFavoritePlacesId(),
            'routes' => app(UserRoutesService::class)->getSelectedPlaces(),
            'pageTitle' => Str::ucfirst($place->title)

        ]);
    }
    public function index(string $title, string $user_slug)
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
            'journeys'=> $places,
            'likes' => app(LikeService::class)->getLikedPlacesId(),
            'favorites' => app(FavoriteService::class)->getFavoritePlacesId(),
            'title' => $type
        ]);

    }

}
