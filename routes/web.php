<?php

use App\Http\Controllers\Account\AccountController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\JourneyController;
use App\Http\Controllers\LikeController;
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
//Route::view('/{path?}', 'app');

// Route::get('/', function () {
//     return view('welcome');
// });

//place


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

    });
});

//favorites
Route::get('/favorite/{place}', [FavoriteController::class, 'favoriteHandling'])
    ->where('place', '\d+')
    ->name('favorite');
// Route::get('/', [HomepageController::class, 'index'])
//     ->name('app::homepage');

// Route::get('/trips', [HomepageController::class, 'travelListing'])
//     ->name('app::trips');

// Route::get('/trips/{id}', [TripController::class, 'detail'])
//     ->name('app::trips::detail');

Auth::routes(['verify' => true]);
Route::get('/logout', [LoginController::class, 'logout'])
    ->name('logout');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
