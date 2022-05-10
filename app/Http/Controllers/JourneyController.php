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
    public function getJourneysWithFilters(Request $request, $page = 1): JsonResponse
    {
        // Определяем фильтры из запроса
        $filters = [
            'city' => $request->city, // город
            'transport' => $request->transport, // вид транспорта
            'complexity' => (int)$request->complexity, // сложность
            'minDistance' => (int)$request->minDistance, //.. и т.д.
            'maxDistance' => $request->maxDistance,
            'minCost' => $request->minCost,
            'maxCost' => $request->maxCost,
        ];
        // Получаем места по 5 штук на заданной странице
        $itemsPerPage = 15;
        $places = Place::getWhithFiltersOnPage($page, $itemsPerPage, $filters);

        if ($places != null) {
            // Извлекаем id мест в массив
            $placesId = [];
            foreach ($places as $place) {
                $placesId[] = $place->place_id;
            }

            // Получаем данные из других таблиц по id места.
            $pictures = Image::getInPlaces($placesId);
            $comments = Comment::getInPlaces($placesId);
            $likes = Like::getInPlaces($placesId);

            return response()->json($this->getFinalData($places, $comments, $likes, $pictures));
        }

        return response()->json(['message' => 'Путешествия не найдены']);

    }

    public function getFinalData($places, $comments, $likes, $pictures): array
    {
        //Слияние массивов в один
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

        return $places;
    }
}
