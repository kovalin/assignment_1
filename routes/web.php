<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\CityController;

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
    return redirect('/business');
});

Route::resource('business', BusinessController::class);
Route::resource('cities', CityController::class);
