<?php

namespace Zaikok\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
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
            $user  = User::where('user_id', Auth::user()->user_id)->first();
            while (true) {
                $token = mt_rand(1111, 9999);
                if (is_null(User::where('line_verify_token', password_hash($token, PASSWORD_DEFAULT))->first())) {
                    break;
                }
            }
            $user->line_verify_token = password_hash($token, PASSWORD_DEFAULT);
            $user->saveOrFail();
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
        Log::info('UserController@createLineVerify', [
           'userId' => $user->user_id,
        ]);
        return $token;
    }
}
