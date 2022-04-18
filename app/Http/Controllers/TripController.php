<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TripController extends Controller
{
    public function index()
    {
       // $trips = Trips::orderBy('updated_at', 'desc')->get();
        return view('trips', ['trips' => $trips]);
    }

    public function detail(int $id)
    {
     //   $trip = Trips::getById($id);
        return view('detail_trip', ['trip' => $trip]);
    }
}
