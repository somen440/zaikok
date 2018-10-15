<?php

namespace Zaikok\Handler;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use LINE\LINEBot;
use LINE\LINEBot\Event\MessageEvent\ImageMessage;
use LINE\LINEBot\MessageBuilder\ImageMessageBuilder;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;

class ImageMessageHandler extends AbstractHandler
{
    public static function create(LINEBot $bot, ImageMessage $imageMessage): self
    {
        $messages = [];
        $contentId = $imageMessage->getMessageId();
        $image = $bot->getMessageContent($contentId)->getRawBody();

        Storage::put('file.jpg', $image);
        $url = Storage::url('file.jpg');
        $messages[] = new TextMessageBuilder($url);
        $messages[] = new ImageMessageBuilder($url, $url);

        Log::info('ImageMessageHandler@create', [
            'url' => $url,
        ]);

        return new self($bot, $imageMessage->getReplyToken(), $messages);
    }
}
