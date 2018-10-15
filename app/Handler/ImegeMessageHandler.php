<?php

namespace Zaikok\Handler;

use LINE\LINEBot;
use LINE\LINEBot\Event\MessageEvent\ImageMessage;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;

class ImegeMessageHandler extends AbstractHandler
{
    public static function create(LINEBot $bot, ImageMessage $imageMessage): self
    {
        $contentId = $imageMessage->getMessageId();
//        $image = $bot->getMessageContent($contentId)->getRawBody();
        $messages[] = new TextMessageBuilder($contentId . ' が来たよ');

        $messages = [];
        return new self($bot, $imageMessage->getReplyToken(), $messages);
    }
}
