<?php

namespace Zaikok\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Zaikok\InventoryGroup;
use Zaikok\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $bearerToken = $user->bearer_token;
        if (is_null($bearerToken)) {
            $bearerToken = $this->firstLogin($user);
        }
        return view('home')->with([
            'token' => $bearerToken,
        ]);
    }

    /**
     * @param User $user
     * @return string|null
     */
    protected function firstLogin(User $user): ?string
    {
        DB::beginTransaction();

        try {
            $token       = $user->createToken('Token Name')->accessToken;
            $bearerToken = $user->bearer_token = $token;
            $user->saveOrFail();

            $inventoryGroup                     = new InventoryGroup;
            $inventoryGroup->inventory_group_id = 1;
            $inventoryGroup->name               = '日用品';
            $inventoryGroup->user_id            = $user->user_id;
            $inventoryGroup->saveOrFail();

            Log::info('HomeController@index 初回ログイン成功', [
                'userId' => $user->user_id,
            ]);

            DB::commit();
            return $bearerToken;
        } catch (\Throwable $e) {
            Log::error('HomeController@index 初回ログイン失敗', [
                'userId' => $user->user_id,
            ]);

            DB::rollBack();
            throw $e;
        }
    }
}
