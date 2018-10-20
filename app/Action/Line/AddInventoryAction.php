<?php

/**
 * Created by PhpStorm.
 * User: yas
 * Date: 2018/10/20
 * Time: 9:56
 */

namespace Zaikok\Action\Line;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use Zaikok\Inventory;
use Zaikok\User;

class AddInventoryAction
{
    public static function execute(?User $user, string $name): TextMessageBuilder
    {
        if (is_null($user)) {
            return new TextMessageBuilder('認証できてへんで');
        }

        $lastInventory = Inventory::findLastByUserIdAndInventoryGroupId(
            $user->user_id,
            $user->current_inventory_group_id
        )
                ->first();

        if (isset($user->temp_image_path)) {
            $imagePath = sprintf('public/%s_%s.jpg', $user->user_id, Carbon::now()->getTimestamp());
            Storage::move($user->temp_image_path, $imagePath);
            $user->temp_image_path = null;
            $user->saveOrFail();
        } else {
            $imagePath = null;
        }

        Inventory::create([
            'inventory_id'       => $nextInventoryId = (is_null($lastInventory) ? 1 : $lastInventory + 1),
            'inventory_group_id' => $user->current_inventory_group_id,
            'user_id'            => $user->user_id,
            'name'               => $name,
            'count'              => 0,
            'image_path'         => $imagePath,
        ]);

        Log::info('AddAction 成功', [
            'user_id'      => $user->user_id,
            'inventory_id' => $nextInventoryId,
        ]);
        return new TextMessageBuilder('追加できたやで');
    }
}