<?php

use Illuminate\Http\Request;
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
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/inventory', function (Request $request) {
        return Inventory::where('user_id', $request->user()->user_id)
            ->orderBy('inventory_id', 'asc')
            ->get()
            ->groupBy('inventory_group_id')
        ;
    });
});
