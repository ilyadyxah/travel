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
            $city = City::find($cityId);

//            $places = DB::table('cities_places as c')
//                ->where('city_id', '=', $cityId)
//                ->join('places as p', 'c.place_id', '=', 'p.id')
//                ->join('places_images as pim', 'c.place_id', '=', 'pim.place_id')
//                ->get();

            return view('blocks.places', [
                'places' => $city->places,
            ]);
        }
    }

    public function testApi()
    {
        return 'Hello';
    }

    public function getAll()
    {
        $places = DB::table('cities_places as cp')
            ->join('cities as c', 'cp.city_id', '=', 'c.id')
            ->join('places as p', 'cp.place_id', '=', 'p.id')
            ->join('images as im', 'p.main_picture_id', '=', 'im.id')
            ->select('p.id as place_id', 'c.title as city', 'p.title', 'p.description', 'im.url as main_picture')
            ->get()
            ->toArray();

        $pictures = DB::table('places_images as pim')
            ->join('images', 'pim.image_id', '=', 'images.id')
            ->select('pim.place_id', 'images.url as image')
            ->get()
            ->toArray();

        $comments = DB::table('comments as c')
            ->select('c.place_id', 'c.user_name', 'c.message')
            ->get()
            ->toArray();

        $likes = DB::table('likes')
            ->groupBy('place_id')
            ->select('place_id')
            ->addSelect(DB::raw('count(*) as likes_count, place_id'))
            ->get()
            ->toArray();

        foreach ($places as $place) {
            foreach ($pictures as $picture) {
                if ($place->place_id == $picture->place_id) {
                    $place->image[] = $picture->image;
                }
            }
            foreach ($comments as $comment) {
                if ($place->place_id == $comment->place_id) {
                    $place->comments[] = [$comment->user_name, $comment->message];
                }
            }
            foreach ($likes as $like) {
                if ($place->place_id == $like->place_id) {
                    $place->likes = $like->likes_count;
                }
            }
        }
        $data = $places;

        return response()->json($data);
    }
}
