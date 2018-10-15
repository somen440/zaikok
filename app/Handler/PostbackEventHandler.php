<?php

namespace Zaikok\Handler;

use LINE\LINEBot\Event\PostbackEvent;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use Zaikok\Inventory;

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

            default:
                throw new \Exception('未定義のコマンド');
        }

        return new self($bot, $postbackEvent->getReplyToken(), $messages);
    }
}
