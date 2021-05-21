<?php

use App\Http\Controllers\PosterController;
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

Route::get('/sortDate', [PosterController::class, 'sortByDate']);

Route::get('/sortPrice', [PosterController::class, 'sortByPrice']);

Route::get('/posters-by-category/{id}', [PosterController::class, 'filterByCategories']);

Route::get('/posters/{id}', [PosterController::class, 'showPoster']);
