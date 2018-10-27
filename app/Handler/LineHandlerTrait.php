<?php

/**
 * Created by PhpStorm.
 * User: yas
 * Date: 2018/10/20
 * Time: 13:36
 */

namespace Zaikok\Handler;

use Illuminate\Support\Facades\Hash;
use Zaikok\LineVerify;
use Zaikok\User;

trait LineHandlerTrait
{
    /**
     * @param string $lineId
     * @return null|User
     */
    private static function getUser(string $lineId): ?User
    {
        $lineVerify = LineVerify::findByLineId(Hash::make($lineId))->first();
        if (is_null($lineVerify)) {
            return null;
        }
        return User::find($lineVerify->user_id);
    }
}
