<?php

use \Illuminate\Support\Facades\Auth;

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
//    if (Auth::guest()) {
//        return view('guest');
//    } else {
//        return redirect('home');
//    }
    var_dump(\Illuminate\Support\Facades\Storage::url('hoge'));
})->name('root');

Auth::routes();

Route::get('/home', 'HomeController@index');
