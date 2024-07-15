<?php

use App\Http\Controllers\PlayerController;
use App\Http\Controllers\StadiumController;
use App\Http\Controllers\Usercontroller;
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

Route::get('users', [Usercontroller::class, 'index']);
Route::post('adduser', [Usercontroller::class, 'adduser']);
Route::post('login', [Usercontroller::class, 'login']);
Route::post('logout', [Usercontroller::class, 'logout']);
Route::post('/playeradd', [PlayerController::class, 'playeradd']);
Route::get('/player', [PlayerController::class, 'index']);
Route::get('/players', [PlayerController::class, 'show']);
Route::put('/player/update/{id}', [PlayerController::class, 'update']);
Route::delete('/player/delete/{id}', [PlayerController::class, 'playerDelete']);
