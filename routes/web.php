<?php

use App\Http\Controllers\Account\AccountController;
use App\Http\Controllers\Account\PlaceController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\JourneyController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\MapRenderController;
use App\Http\Controllers\ParseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


 Route::get('/', [HomepageController::class, 'index'])
     ->name('app::home');

 Route::match(['get', 'post'], '/journeys', [JourneyController::class, 'getJourneysWithFilters'])
     ->name('app::journeys');


Route::get('/places/{place}', [JourneyController::class, 'show'])
    ->where('place', '\d+')
    ->name('places.show');

//likes
Route::get('/like/{place}', [LikeController::class, 'likeHandling'])
    ->where('place', '\d+')
    ->name('like');
Route::get('/like/count/{place}', [LikeController::class, 'placeLikeCount'])
    ->where('place', '\d+')
    ->name('like');

//account
Route::group(['middleware' => ['auth']], function (){

    Route::group(['as' => 'account.', 'prefix' => 'my'], function (){

        Route::resources([
            '/place' => PlaceController::class,
        ]);
        Route::get('/profile', [AccountController::class, 'index'])
//            ->middleware('verified')
            ->name('profile');
        Route::get('/{title}/places', [AccountController::class, 'myPlaces'])
//            ->middleware('verified')
//            ->where('title', '\W+')
            ->name('places');
        Route::get('/info/{data}', [AccountController::class, 'getInfo'])
//            ->middleware('verified')
            ->name('info');

        Route::get('/place', [PlaceController::class, 'index'])
            ->name('place');

    });
});

//favorites
Route::get('/favorite/{place}', [FavoriteController::class, 'favoriteHandling'])
    ->where('place', '\d+')
    ->name('favorite');

Auth::routes(['verify' => true]);

Route::get('/logout', [LoginController::class, 'logout'])
    ->name('logout');

//parsing
Route::get('/admin/parse', [ParseController::class, 'parse'])
    ->name('app::parse');

//map
Route::get('/map', [MapRenderController::class, 'render'])
    ->name('app::map');
