<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Place;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory as FactoryAlias;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return Application|FactoryAlias|View
     */
    public function index()
    {


        return view('home', [
            'places' => Place::all(),
            'images' => Image::all(),
        ]);
    }
}
