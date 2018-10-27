<?php

namespace Zaikok\Handler;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use LINE\LINEBot;
use LINE\LINEBot\Event\MessageEvent\ImageMessage;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use Zaikok\LineVerify;
use Zaikok\User;

class ImageMessageHandler extends AbstractHandler
{
    use LineHandlerTrait;

    public static function create(LINEBot $bot, ImageMessage $imageMessage): self
    {
        $messages   = [];
        $lineVerify = self::getLineVerify($imageMessage->getUserId());
        if ($lineVerify instanceof LineVerify) {
            $contentId = $imageMessage->getMessageId();
            $image     = $bot->getMessageContent($contentId)->getRawBody();

            $filePath = sprintf('public/%s.jpg', $imageMessage->getUserId() . Carbon::now()->getTimestamp());
            Storage::put($filePath, $image);

            $lineVerify->temp_image_path = $filePath;
            $lineVerify->saveOrFail();

            $url        = asset(Storage::url($filePath));
            $messages[] = new TextMessageBuilder($url);

            Log::info('ImageMessageHandler@create', [
                'url' => $url,
            ]);
        } else {
            $messages[] = new TextMessageBuilder('認証してそ');
        }
        return new self($bot, $imageMessage->getReplyToken(), $messages);
    }
}
