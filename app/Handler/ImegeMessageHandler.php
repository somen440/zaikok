<?php

namespace Zaikok\Handler;

use Illuminate\Support\Facades\Storage;
use LINE\LINEBot\Event\MessageEvent\ImageMessage;
use LINE\LINEBot\MessageBuilder\ImageMessageBuilder;

class ImegeMessageHandler extends AbstractHandler
{
    public static function create($bot, ImageMessage $imageMessage): self
    {
        $messages = [];
        $contentId = $imageMessage->getMessageId();
        $image = $bot->getMessageContent($contentId)->getRawBody();

        Storage::put('file.jpg', $image);
        $url = Storage::url('file.jpg');
        $messages[] = new ImageMessageBuilder($url, $url);

        return new self($bot, $imageMessage->getReplyToken(), $messages);
    }
}
