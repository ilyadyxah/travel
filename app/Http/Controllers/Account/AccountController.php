<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Source;
use App\Models\User;
use App\Services\AccountInfoService;
use App\Services\CreatedPlaceService;
use App\Services\FavoriteService;
use App\Services\LikeService;
use App\Services\UserRoutesService;

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
        $type = match ($title) {
            'liked' => 'любимые',
            'favorite' => 'избранные',
            'created' => 'созданные',
        };
        return view('account.places', [
            'journeys' => app(AccountInfoService::class)->getUserPlaces($title),
            'images' => Image::all(),
            'likes' => app(LikeService::class)->getLikedPlacesId(),
            'favorites' => app(FavoriteService::class)->getFavoritePlacesId(),
            'title' => $type,
            'routes' => app(UserRoutesService::class)->getSelectedPlaces(),
        ]);
    }

    public function getInfo($data)
    {
        return app(AccountInfoService::class)->getPlacesInfo($data);
    }

    public function privateHandle(User $user)
    {
            try {
                if ($user->is_private) {
                    $user->is_private = false;
                } else {
                    $user->is_private = true;
                }

                $user->save();

                $response['is_private'] = $user->is_private;

                return response()->json($response);

            } catch (\Exception $e) {
                return response()->json('error', 400);
            }

    }

}
