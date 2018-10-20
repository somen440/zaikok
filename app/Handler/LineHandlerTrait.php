<?php

/**
 * Created by PhpStorm.
 * User: yas
 * Date: 2018/10/20
 * Time: 13:36
 */

namespace Zaikok\Handler;

use PhpParser\Node\Scalar\MagicConst\Line;
use Zaikok\User;

trait LineHandlerTrait
{
    /**
     * @param string $lineId
     * @return null|User
     */
    private static function getUser(string $lineId): ?User
    {
        $lineVerify = Line::findByLineId($lineId)->first();
        if (is_null($lineVerify)) {
            return null;
        }
        return User::find($lineVerify->user_id);
    }
}
