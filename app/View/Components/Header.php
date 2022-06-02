<?php

namespace App\View\Components;

use App\Services\CreatedPlaceService;
use App\Services\FavoriteService;
use App\Services\LikeService;
use Illuminate\View\Component;

class Header extends Component
{


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.header',
            [

                'likes' => app(LikeService::class)->getLikedPlacesId(),
                'favorites' => app(FavoriteService::class)->getFavoritePlacesId(),
                'created' => app(CreatedPlaceService::class)->getCreatedPlacesIds(),
            ]);
    }
}

