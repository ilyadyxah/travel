<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\Route;
use App\Services\UserRoutesService;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UsersRouteController extends Controller
{
    private UserRoutesService $userRoutes;

    public function __construct(UserRoutesService $userRoutes)
    {
        $this->userRoutes = $userRoutes;
    }

    public function routeHandling(Place $place): JsonResponse
    {
        return $this->userRoutes->routeHandle($place);
    }

    public function showRoutes(): Factory|View|Application
    {
        $places = Place::query()
            ->join('routes', 'routes.place_id', '=', 'places.id')
            ->where('user_id', Auth::user()->getAuthIdentifier())
            ->get('places.*');

        $places2 = Route::query()
            ->where('user_id', Auth::user()->getAuthIdentifier())
            ->get();

        return view('account.routes', [
            'journeys' => $places,
        ]);
    }

    public function delete($id): JsonResponse
    {
        {
            try {
                $route = Route::query()
                    ->where('user_id', Auth::user()->getAuthIdentifier())
                    ->where('place_id', $id);

                if ($route->exists()) {
                    $route->delete();
                    $response = [
                        'state' => 'success',
                    ];
                }

                return response()->json($response);

            } catch (Exception $e) {
                return response()->json('error', 400);
            }

        }
    }
}
