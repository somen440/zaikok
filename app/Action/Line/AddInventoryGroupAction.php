<?php

/**
 * Created by PhpStorm.
 * User: yas
 * Date: 2018/10/20
 * Time: 11:17
 */

namespace Zaikok\Action\Line;

use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use Zaikok\InventoryGroup;
use Zaikok\User;

class AddInventoryGroupAction
{
    public static function execute(?User $user, string $name): TextMessageBuilder
    {
        if (is_null($user)) {
            return new TextMessageBuilder('認証しようず');
        }

        $nextInventoryGroupId = InventoryGroup::findLastByUserId(
            $user->user_id
        )
            ->first()
            ->inventory_group_id + 1;

        InventoryGroup::create([
            'inventory_group_id' => $nextInventoryGroupId,
            'user_id'            => $user->user_id,
            'name'               => $name,
        ]);
        return new TextMessageBuilder('追加でけたで');
    }
}
