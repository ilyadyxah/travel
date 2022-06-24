<?php

namespace App\Services;

use App\Models\Place;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;

class AccountInfoService
{
    public function getPlacesInfo($data): \Illuminate\Http\JsonResponse
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

        } catch (\Exception $e) {
            return response()->json('error', 400);
        }
    }

    /**
     * @param string $title
     * @return Collection|array
     */
    public function getUserPlaces(string $title): Collection|array
    {
        switch ($title) {
            case 'liked':
                $places = Place::query()
                    ->join('likes', 'likes.place_id', '=', 'places.id')
                    ->where('user_id', Auth::user()->getAuthIdentifier())
                    ->get('places.*');
                break;
            case 'favorite':
                $places = Place::query()
                    ->join('favorites', 'favorites.place_id', '=', 'places.id')
                    ->where('user_id', Auth::user()->getAuthIdentifier())
                    ->get('places.*');
                break;
            case 'created':
                $places = Place::query()
                    ->where('created_by_user_id', Auth::user()->getAuthIdentifier())
                    ->get();
                break;
            default:
                $places = [];
        }

        return $places;

    }
}
