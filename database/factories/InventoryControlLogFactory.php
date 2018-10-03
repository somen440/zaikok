<?php

use Faker\Generator as Faker;
use Illuminate\Support\Carbon;

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

$factory->define(\Zaikok\InventoryControlLog::class, function (Faker $faker) {
    return [
        'inventory_id' => mt_rand(1, 100),
        'user_id' => 1,
        'type' => mt_rand(1, 2),
        'count' => mt_rand(-10, 10),
        'created_at' => Carbon::today(),
        'updated_at' => Carbon::today(),
    ];
});
