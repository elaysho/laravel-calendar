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

Route::get('/vue/{any}', function () {
    return view('layout.vue');
})->where('any', '.*')->name('vue.app');

Route::get('/', function() {
    return redirect('/vue/calendar');
});
