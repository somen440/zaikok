<?php

namespace Zaikok\Handler;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use LINE\LINEBot;
use LINE\LINEBot\Event\MessageEvent\ImageMessage;
use LINE\LINEBot\MessageBuilder\ImageMessageBuilder;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use Zaikok\User;

class ImageMessageHandler extends AbstractHandler
{
    public static function create(LINEBot $bot, ImageMessage $imageMessage): self
    {
        $messages = [];
        $user     = User::where('line_user_id', $imageMessage->getUserId())->first();
        if ($user instanceof User) {
            $contentId = $imageMessage->getMessageId();
            $image     = $bot->getMessageContent($contentId)->getRawBody();

            $filePath = sprintf('public/%s.jpg', $imageMessage->getUserId() . Carbon::now()->getTimestamp());
            Storage::put($filePath, $image);

            $user->temp_image_path = $filePath;
            $user->saveOrFail();

            $url        = asset(Storage::url($filePath));
            $messages[] = new TextMessageBuilder($url);
            $messages[] = new ImageMessageBuilder($url, $url);

            Log::info('ImageMessageHandler@create', [
                'url' => $url,
            ]);
        } else {
            $messages[] = new TextMessageBuilder('認証してそ');
        }

        return new self($bot, $imageMessage->getReplyToken(), $messages);
    }
}
