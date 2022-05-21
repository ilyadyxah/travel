<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home', [
            'places' => Place::get(),
        ]);
    }
}
