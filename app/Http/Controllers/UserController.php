<?php

namespace Zaikok\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
     * @return int
     * @throws \Throwable
     */
    public function createLineVerify(): int
    {
        DB::beginTransaction();
        try {
            $token = null;
            $user  = User::find(Auth::user()->user_id)->first();
            while (true) {
                $token = mt_rand(1111, 9999);
                if (is_null(User::where('line_verify_token', $token)->first())) {
                    break;
                }
            }
            $user->line_verify_token = Hash::make($token);
            $user->saveOrFail();
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
        return $token;
    }
}
