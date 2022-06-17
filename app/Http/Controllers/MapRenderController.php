<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class MapRenderController extends Controller
{
    public function render(): Factory|View|Application
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
                "geometry" => ["type" => "Point", "coordinates" => [$place->latitude, $place->longitude]],
                "properties" => [
                "balloonContentHeader" =>
                    "<span style=\"font-size: small; \"><b>$place->title</b></span>"
                    . sprintf("<b><a target='_blank' href=%s style='text-decoration: none'> > </a></b>", route('places.show', ['place' => $place->id])),
                "balloonContentBody" =>
                    sprintf(
                    "<a target='_blank' href=%s><img src=%s style='height: 200px'></a>",
                    route('places.show', ['place' => $place->id]),
                        asset($place->images->first()->url)),
                    "hintContent" => $place->title,
                ]
            ];
        }

        return response()->json($data);
    }
}
