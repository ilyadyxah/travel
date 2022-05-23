<?php

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

 Route::get('/', [HomepageController::class, 'index'])
     ->name('app::home');

 Route::match(['get', 'post'], '/journeys', [JourneyController::class, 'getJourneysWithFilters'])
     ->name('app::journeys');

//likes
//Route::get('/like/{place}', [LikeController::class, 'likeHandling'])
//    ->where('place', '\d+')
//    ->name('like');
//Route::get('/like/count/{place}', [LikeController::class, 'placeLikeCount'])
//    ->where('place', '\d+')
//    ->name('like');

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
