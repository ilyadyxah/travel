<?php

use App\Http\Controllers\HomepageController;
use App\Http\Controllers\TripController;
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
Route::view('/{path?}', 'app');

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/homepage', [HomepageController::class, 'index'])
//     ->name('app::homepage');

// Route::get('/trips', [TripController::class, 'index'])
//     ->name('app::trips');

// Route::get('/trips/{id}', [TripController::class, 'detail'])
//     ->name('app::trips::detail');
