<?php

namespace App\Services;

use App\Models\Place;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserRoutesService
{
    public function routeHandle(Place $place): JsonResponse
    {
        try {
            if (Auth::check()) {
                $routes = DB::table('routes')
                    ->where('place_id', '=', $place->id)
                    ->where('user_id', '=', Auth::user()->getAuthIdentifier());
            } else {

                throw new Exception('Вы не авторизованы');
            }
            if ($routes->exists()) {
                $routes->delete();
                $response = [
                    'state' => 'addRoute',
                ];
            } else {
                if (count($this->getSelectedPlaces()) > 9) {
                    throw new Exception('Нельзя добавлять больше 10 маршрутов');
                } else {
                    DB::table('routes')->insert([
                        'place_id' => $place->id,
                        'user_id' => Auth::user()->id ?? 1,
                    ]);
                    $response = [
                        'state' => 'removeRoute',
                    ];
                }
            }
            $response['total'] = $place->routes->count();

            return response()->json($response);

        } catch (Exception $e) {

            return response()->json($e->getMessage(), 400);
        }
    }

    public function getSelectedPlaces(): array
    {
        $placesId = [];
        $data = Auth::check()
            ? DB::table('routes')
                ->where('user_id', Auth::user()->getAuthIdentifier())
                ->get()
                ->toArray()
            : null;
        foreach ($data as $value) {
            $placesId[] = $value->place_id;
        }

        return $placesId;
    }
}
