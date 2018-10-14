<?php

namespace Zaikok\Handler;

use LINE\LINEBot;
use LINE\LINEBot\Event\PostbackEvent;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use Zaikok\Inventory;

class PostbackEventHandler extends AbstractHandler
{
    public static function create(LINEBot $bot, PostbackEvent $postbackEvent): self
    {
        [$type, $id] = explode('?', $postbackEvent->getPostbackData());
        $messages[] = new TextMessageBuilder(sprintf(
            'ゴリラの %s くんを %s （気持ち）したよ。',
            $id,
            Inventory::TYPE_STRING_MAP[$type]
        ));
        return new self($bot, $postbackEvent->getReplyToken(), $messages);
    }
}
