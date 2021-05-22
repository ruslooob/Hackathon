<?php

use App\Http\Controllers\PosterController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;

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

// user root
Route::get('/user-create', function (Request $request) {
    User::create([
        'name' => 'Дмитрий',
        'password' => Hash::make('password'),
    ]);
});

Route::post('/login', function (Request  $request) {
    $credentials = request()->only(['name', 'password']);

    $token = auth()->attempt($credentials);

    return $token;
});

Route::middleware('auth:api')->get('/me', function() {
    return auth()->user();
});

Route::get('/create', [PosterController::class, 'create']);

Route::get('/posters-sort-by-date', [PosterController::class, 'sortByDate']);

Route::get('/posters-sort-by-price', [PosterController::class, 'sortByPrice']);

Route::get('/posters-by-category/{id}', [PosterController::class, 'filterByCategories']);

Route::get('/posters', [PosterController::class, 'indexPoster']);

Route::get('/posters/{id}', [PosterController::class, 'showPoster']);
