<?php

use Faker\Generator as Faker;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(\Zaikok\Inventory::class, function (Faker $faker) {
    $inventoryGroupId = mt_rand(1, 3);
    $code             = $faker->unique()->regexify("/^$inventoryGroupId-[1-9]{1}[0-9]{0,5}$/");
    $inventoryId      = intval(explode('-', $code)[1]);

    Log::info('InventoryFactory', [
        'inventoryGroupId' => $inventoryGroupId,
        'inventoryId'      => $inventoryId,
        'code'             => $code,
    ]);

    return [
        'inventory_id'       => $inventoryId,
        'inventory_group_id' => $inventoryGroupId,
        'user_id'            => 1,
        'name'               => $faker->word,
        'count'              => mt_rand(0, 10),
        'created_at'         => Carbon::today(),
        'updated_at'         => Carbon::today(),
    ];
});
