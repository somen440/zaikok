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
use Zaikok\LineVerify;
use Zaikok\User;

class AddInventoryAction
{
    public static function execute(?LineVerify $lineVerify, string $name): TextMessageBuilder
    {
        if (is_null($lineVerify)) {
            return new TextMessageBuilder('認証できてへんで');
        }

        $lastInventory = Inventory::findLastByUserIdAndInventoryGroupId(
            $lineVerify->user_id,
            $lineVerify->current_inventory_group_id
        )
            ->first();

        if (isset($lineVerify->temp_image_path)) {
            $imagePath = sprintf('%s_%s.jpg', $lineVerify->user_id, Carbon::now()->getTimestamp());
            Storage::disk('s3')->move($lineVerify->temp_image_path, sprintf('public/%s', $imagePath));
            $lineVerify->temp_image_path = null;
            $lineVerify->saveOrFail();
        } else {
            $imagePath = null;
        }

        Inventory::create([
            'inventory_id'       => $nextInventoryId = (is_null($lastInventory) ? 1 : $lastInventory->inventory_id + 1),
            'inventory_group_id' => $lineVerify->current_inventory_group_id,
            'user_id'            => $lineVerify->user_id,
            'name'               => $name,
            'count'              => 0,
            'image_path'         => $imagePath,
        ]);

        Log::info('AddAction 成功', [
            'user_id'      => $lineVerify->user_id,
            'inventory_id' => $nextInventoryId,
        ]);
        return new TextMessageBuilder('追加できたやで');
    }
}