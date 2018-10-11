<?php

use Illuminate\Http\Request;
use Zaikok\Http\Controllers\InventoryController;
use Zaikok\Http\Controllers\InventoryGroupController;
use Zaikok\Http\Controllers\UserController;
use Zaikok\Inventory;

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

Route::middleware(['auth:api'])->group(function () {
    Route::prefix('user')->group(function () {
        Route::get('', 'UserController@get');
    });

    Route::prefix('inventory')->group(function () {
        Route::get('/{inventory_group_id}', 'InventoryController@show');
        Route::post('', 'InventoryController@create');
        Route::put('{id}', 'InventoryController@edit');
        Route::delete('/{id}', 'InventoryController@delete');
        Route::delete('', 'InventoryController@deleteAll');
    });

    Route::prefix('inventory_group')->group(function () {
        Route::get('', 'InventoryGroupController@getList');
        Route::post('', 'InventoryGroupController@create');
        Route::put('/{id}', 'InventoryGroupController@edit');
        Route::delete('/{id}', 'InventoryGroupController@delete');
    });
});
Route::post('/callback', 'CallbackController@index');
