<?php

use App\Http\Controllers\StadiumController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Usercontroller;
use App\Http\Controllers\playercontroller;

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

Route::get('/', function () {
    return view('home');
});

Route::post('/register',[Usercontroller::class,'register']) ;
Route::post('/logout',[Usercontroller::class,'logout']) ;
Route::post('/login',[Usercontroller::class,'login']) ;

Route::get('/player', [PlayerController::class, 'player'])->name('player.view');
Route::post('/registerP', [PlayerController::class, 'store'])->name('player.add');

Route::get('/stadium', [StadiumController::class, 'stadium'])->name('stadium.view');
Route::post('/stadium', [StadiumController::class, 'stadiumAdd'])->name('stadium.add');
Route::get('/api/stadium-dates', [StadiumController::class, 'getStadiumDates']);
Route::get('/stadiumdisplay', [StadiumController::class, 'stadiumdisplay'])->name('stadium.display');
Route::put('/stadiums/{stadium}', [StadiumController::class, 'stadiumUpdate'])->name('stadium.update');
Route::delete('/stadiums/{stadium}', [StadiumController::class, 'stadiumDelete'])->name('stadium.delete');
