<?php

namespace Zaikok\Http\Controllers;

use Faker\Generator as Faker;
use Illuminate\Http\Request;
use Zaikok\User;

/**
 * Class UserController
 * @package Zaikok\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * @param Request $request
     * @return User
     */
    public function get(Request $request): User
    {
        return $request->user();
    }

    /**
     * @param Faker $faker
     * @return int[]
     */
    public function createLineVerify(Faker $faker): array
    {
        foreach (range(1, 1000) as $index) {
            $faker->numberBetween(1000, 9999);
        }
        return [1, 2, 3, 4];
    }
}
