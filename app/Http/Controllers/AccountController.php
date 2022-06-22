<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\CreatedPlaceService;
use App\Services\FavoriteService;
use App\Services\LikeService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AccountController extends Controller
{
    public function showProfile(string $slug) : View
    {
        $user = User::where('slug', $slug)->firstOrFail();

        return view('public_profile', [
            'user' => $user,
            'likes' => app(LikeService::class)->getLikedPlacesIdByUser($user),
            'favorites' => app(FavoriteService::class)->getFavoritePlacesIdByUser($user),
            'created' => app(CreatedPlaceService::class)->getCreatedPlacesIdsByUser($user),
        ]);
    }

    public function unauthorized(User $user): Factory|\Illuminate\Contracts\View\View|Application
    {

        return view('auth.unauthorized',
            [
                'user' => $user,
            ]);
    }
}
