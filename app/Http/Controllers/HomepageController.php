<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomepageController extends Controller
{
    public function index()
    {
        $cities = City::orderBy('updated_at', 'desc')->get();

        return view('index', ['cities' => $cities]);
    }

    public function travelListing(Request $request)
    {
        if ($request->ajax()) {
            $cityId = $request['cityId'];
            $places = DB::table('cities_places as c')
                ->where('city_id', '=', $cityId)
                ->join('places as p', 'c.place_id', '=', 'p.id')
                ->join('places_images as pim', 'c.place_id', '=', 'pim.place_id')
                ->get();

            return view('blocks.places', [
                'places' => $places,
            ]);
        }
    }
}
