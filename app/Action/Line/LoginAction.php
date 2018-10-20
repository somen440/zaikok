<?php
/**
 * Created by PhpStorm.
 * User: yas
 * Date: 2018/10/20
 * Time: 11:05
 */

namespace Zaikok\Action\Line;

use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use Zaikok\User;

class LoginAction
{
    public static function execute(int $lineVerifyToken): TextMessageBuilder
    {
        $user = User::findByLineVerifyToken($lineVerifyToken)->first();
        if (is_null($user)) {
            return new TextMessageBuilder('見つからんからもっかいやって。。。');
        }

        $user->line_verify_token = null;
        $user->line_id = $lineVerifyToken;
        $user->saveOrFail();

        return new TextMessageBuilder("ようこそ!! {$user->name} さん");
    }
}
