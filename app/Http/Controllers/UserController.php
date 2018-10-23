<?php

namespace Zaikok\Http\Controllers;

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
     * @return int[]
     */
    public function createLineVerify(): array
    {
        return [1, 2, 3, 4];
    }
}
