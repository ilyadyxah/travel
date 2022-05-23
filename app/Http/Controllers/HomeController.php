<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Place;
use App\Services\LikeService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home', [
            'places' => Place::all(),
            'images' => Image::all(),
            'likes' => app(LikeService::class)->getLikedPlacesId(),

        ]);
    }
}
