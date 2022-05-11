<?php

use App\Http\Controllers\FilterController;
use App\Http\Controllers\JourneyController;
use App\Http\Controllers\LikeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/journeys/{page?}', [JourneyController::class, 'getJourneysWithFilters'])
    ->where('page', '\d+')
    ->name('journeyList');

Route::get('/journeys/{like}/{place_id}', [LikeController::class, 'likeHandle'])
    ->where('place_id', '\d+')
    ->name('likeHandle');

Route::get('/filters/cities', [FilterController::class, 'getCityFilter'])
    ->name('cities');
Route::get('/filters/transports', [FilterController::class, 'getTransportFilter'])
    ->name('transports');
