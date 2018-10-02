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

$factory->define(\Zaikok\Inventory::class, function (Faker $faker) {
    return [
        'inventory_id' => mt_rand(1, 100),
        'inventory_group_id' => mt_rand(1, 10),
        'user_id' => 1,
        'name' => $faker->word,
        'count' => mt_rand(0, 10),
        'created_at' => Carbon::today(),
        'updated_at' => Carbon::today(),
    ];
});
