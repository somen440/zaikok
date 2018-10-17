<?php

namespace Zaikok\Handler;

use LINE\LINEBot;
use LINE\LINEBot\Event\PostbackEvent;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use Zaikok\Inventory;
use Zaikok\InventoryGroup;
use Zaikok\User;

class PostbackEventHandler extends AbstractHandler
{
    public static function create(LINEBot $bot, PostbackEvent $postbackEvent): self
    {
        [$command, $id] = explode('?', $postbackEvent->getPostbackData());

        $messages = [];
        switch ($command) {
            case 'increment':
                $inventory = Inventory::find($id);
                $inventory->count++;
                $inventory->saveOrFail();
                $messages[] = new TextMessageBuilder('増やしたよ');
                break;

            case 'decrement':
                $inventory = Inventory::find($id);
                $inventory->count--;
                $inventory->saveOrFail();
                $messages[] = new TextMessageBuilder('減らしたよ');
                break;

            case 'delete':
                Inventory::find($id)->delete();
                $messages[] = new TextMessageBuilder('削除したよ');
                break;

            case 'group':
                $user = User::where('line_id', $postbackEvent->getUserId())->first();
                $user->current_inventory_group_id = $id;
                $user->saveOrFail();
                $messages[] = new TextMessageBuilder('切り替えたよ');
                break;

            case 'delete-group':
                InventoryGroup::find($id)->delete();
                break;

            default:
                throw new \Exception('未定義のコマンド');
        }

        return new self($bot, $postbackEvent->getReplyToken(), $messages);
    }
}
