<?php

use App\Http\Controllers\DataController;
use App\Http\Controllers\PosterController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/create', [PosterController::class, 'create']);

Route::get('/posters-sort-by-date', [PosterController::class, 'sortByDate']);

Route::get('/posters-sort-by-price', [PosterController::class, 'sortByPrice']);

Route::get('/posters-by-category/{id}', [PosterController::class, 'filterByCategories']);

Route::get('/posters', [PosterController::class, 'indexPoster']);
Route::get('/posters/{id}', [PosterController::class, 'showPoster']);




Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'authenticate']);
Route::get('open', [DataController::class. 'open']);

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('user', [UserController::class, 'getAuthenticatedUser']);
    Route::get('closed', [DataController::class, 'closed']);
});
