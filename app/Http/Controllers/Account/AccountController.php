<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Place;
use App\Services\FavoriteService;
use App\Services\LikeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    public function index()
    {
        return view('account.profile', [
            'likes' => app(LikeService::class)->getLikedPlacesId(),
            'favorites' => app(FavoriteService::class)->getFavoritePlacesId()
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
            case 2:
                echo "i equals 2";
                break;
        }
        return view('account.places', [
            'places' => $places,
            'images' => Image::all(),
            'likes' => app(LikeService::class)->getLikedPlacesId(),
            'favorites' => app(FavoriteService::class)->getFavoritePlacesId(),
            'title' => $type
        ]);
    }
}
