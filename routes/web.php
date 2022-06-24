<?php

use App\Http\Controllers\Account\AccountController;
use App\Http\Controllers\Account\PlaceController;
use App\Http\Controllers\Account\MessageController as AccountMessageController;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\JourneyController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\MapRenderController;
use App\Http\Controllers\ParseController;
use App\Http\Controllers\UsersRouteController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController as PublicAccountController;

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


// mail
Route::get('/email', function (){
    return new \App\Mail\NewMessageMail(\App\Models\Message::find(1));
});

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


//public profile
Route::group(['as' => 'profile.', 'prefix' => 'profile'], function (){
    Route::get('/{user_slug}', [PublicAccountController::class, 'showProfile'])
//    ->where('slug', '\w+')
    ->name('show');
    Route::get('{title}/journeys/{user_slug}', [JourneyController::class, 'index'])
//        ->where('place', '\d+')
        ->name('places.index');
});

//routes
Route::get('/route/{place}', [UsersRouteController::class, 'routeHandling'])
    ->where('place', '\d+')
    ->name('route');
Route::get('/routes', [UsersRouteController::class, 'showRoutes'])
    ->name('show::routes');
Route::get('/route/delete/{id}', [UsersRouteController::class, 'delete'])
    ->name('delete::routes');

//account
Route::group(['middleware' => ['auth']], function (){

    //        private or not
    Route::get('/private/{user}', [AccountController::class, 'privateHandle'])
        ->where('user', '\d+')
        ->middleware('isItYou')
        ->name('private')
    ;

    Route::group(['as' => 'account.', 'prefix' => 'my'], function (){

        Route::resources([
            '/place' => PlaceController::class,
            '/message' => AccountMessageController::class,
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

        Route::get('/message', [AccountMessageController::class, 'index'])
            ->name('message');
    });
});
Route::get('/unauthorized/{user}', [PublicAccountController::class, 'unauthorized'])
    ->where('user', '\d+')
    ->name('unauthorized');

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
