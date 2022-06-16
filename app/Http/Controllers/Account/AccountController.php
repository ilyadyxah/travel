<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Place;
use App\Models\Source;
use App\Services\CreatedPlaceService;
use App\Services\FavoriteService;
use App\Services\LikeService;
use App\Services\UserRoutesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    public function index()
    {
        return view('account.profile', [
            'likes' => app(LikeService::class)->getLikedPlacesId(),
            'favorites' => app(FavoriteService::class)->getFavoritePlacesId(),
            'created' => app(CreatedPlaceService::class)->getCreatedPlacesIds(),
            'sources' => Source::all(),
        ]);
    }

    public function myPlaces(string $title)
    {
        switch ($title) {
            case 'liked':
                $places = Place::query()
                    ->join('likes', 'likes.place_id', '=', 'places.id')
                    ->where('user_id', Auth::user()->getAuthIdentifier())
                    ->get('places.*');
                $type = 'любимые';
                break;
            case 'favorite':
                $places = Place::query()
                    ->join('favorites', 'favorites.place_id', '=', 'places.id')
                    ->where('user_id', Auth::user()->getAuthIdentifier())
                    ->get('places.*');
                $type = 'избранные';
                break;
            case 'created':
                $places = Place::query()
                    ->where('created_by_user_id', Auth::user()->getAuthIdentifier())
                    ->get();
                $type = 'созданные';
                break;
        }
        return view('account.places', [
            'journeys'=> $places,
            'images' => Image::all(),
            'likes' => app(LikeService::class)->getLikedPlacesId(),
            'favorites' => app(FavoriteService::class)->getFavoritePlacesId(),
            'title' => $type
        ]);
    }

    public function getInfo($data)
    {
        try {
            switch ($data) {
                case 'likes':
                    $response = app(LikeService::class)->getLikedPlacesId();
                    break;
                case 'favorites':
                    $response = app(FavoriteService::class)->getFavoritePlacesId();
                    break;
                default:
                    $response['likes'] = app(LikeService::class)->getLikedPlacesId();
                    $response['favorites'] = app(FavoriteService::class)->getFavoritePlacesId();
            }
            return response()->json($response);

        } catch(\Exception $e){
            return response()->json('error', 400);
        }
    }
}
