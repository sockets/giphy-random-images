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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/history', [App\Http\Controllers\UserHistoryController::class, 'index'])->name('history');
Route::get('/delete/{id}', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\UserHistoryController@destroy'])->name('deleteHistory');
Route::post('giphy', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\GiphyController@giphySearch'])->name('giphy');