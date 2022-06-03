<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\JsonResponse;

class MapRenderController extends Controller
{
    public function render()
    {
        return view('map');
    }

    public function getData(): JsonResponse
    {
        $places = Place::query()
            ->select(['id', 'title', 'longitude', 'latitude'])
            ->get();

        $data = [
            'type' => 'FeatureCollection',
            'features' => []
        ];

        foreach ($places as $place) {
            $data['features'][] =
                [
                "type" => "Feature",
                "id" => $place->id,
                "geometry" => ["type" => "Point", "coordinates" => [$place->longitude, $place->latitude]],
                "properties" => [
                "balloonContentHeader" => sprintf("<span style=\"font-size: small; \"><b><a target='_blank' href=%s> $place->title </a></b></span>", route('places.show', ['place' => $place->id]))
                ]
            ];
        }

        return response()->json($data);
    }
}
