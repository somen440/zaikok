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

trait LineHandlerTrait
{
    /**
     * @param string $lineId
     * @return null|LineVerify
     */
    private static function getLineVerify(string $lineId): ?LineVerify
    {
        return LineVerify::findByLineId(Hash::make($lineId))->first();
    }
}
