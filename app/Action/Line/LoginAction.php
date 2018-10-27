<?php
/**
 * Created by PhpStorm.
 * User: yas
 * Date: 2018/10/20
 * Time: 11:05
 */

namespace Zaikok\Action\Line;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use Zaikok\LineVerify;
use Zaikok\User;

class LoginAction
{
    public static function execute(int $lineVerifyToken, string $lineId): TextMessageBuilder
    {
        $user = User::findByLineVerifyToken(password_hash($lineVerifyToken, PASSWORD_DEFAULT))->first();
        if (is_null($user)) {
            Log::warning('LoginAction@execute', [
                'lineVerifyToken' => password_hash($lineVerifyToken, PASSWORD_DEFAULT),
            ]);
            return new TextMessageBuilder('見つからんからもっかいやって。。。');
        }

        $user->line_verify_token = null;
        $user->saveOrFail();

        LineVerify::create([
            'line_id' => password_hash($lineId, PASSWORD_DEFAULT),
            'user_id' => $user->user_id,
        ]);

        return new TextMessageBuilder("ようこそ!! {$user->name} さん");
    }
}
