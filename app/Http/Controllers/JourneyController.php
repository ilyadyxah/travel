<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Image;
use App\Models\Like;
use App\Models\Place;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class JourneyController extends Controller
{
    public function getJourneysWithFilters(Request $request, $page = 1)
    {
        // Определяем фильтры из запроса
        $filters = [
            'city' => $request->city, // город
            'transport' => $request->transport, // вид транспорта
            'complexity' => $request->complexity, // сложность
            'minDistance' => $request->minDistance, //.. и т.д.
            'maxDistance' => $request->maxDistance,
            'minCost' => $request->minCost,
            'maxCost' => $request->maxCost,
        ];
        // Получаем места по 5 штук на заданной странице
        $itemsPerPage = 15;
        $places = Place::getWhithFiltersOnPage($page, $itemsPerPage, $filters);

        if ($places->count() !== 0) {
            return view('trips', [
                'images' => Image::all(),
                'journeys' => $places,
            ]);
        }

        return view('trips', [
            'message' => 'Путешествия не найдены',
        ]);

    }
}
