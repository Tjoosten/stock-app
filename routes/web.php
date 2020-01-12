<?php

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

use App\Http\Controllers\Auth\Settings\InformationController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/account/instellingen', [InformationController::class, 'index'])->name('account.information');
Route::patch('/account/instellingen', [InformationController::class, 'update'])->name('account.information.update');

Route::get('/home', 'HomeController@index')->name('home');
