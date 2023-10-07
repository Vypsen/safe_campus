<?php

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
Route::get('/', \App\Http\Controllers\SearchController::class . "@indexScore")
    ->name('score');

//Route::get('/', function () {
//
//    return view('map');
//    return \Illuminate\Support\Facades\DB::select('SELECT * FROM customers');
//});
