<?php

namespace Zaikok\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Log\Logger;
use LINE\LINEBot;
use LINE\LINEBot\Constant\HTTPHeader;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot\MessageBuilder\FlexMessageBuilder;
use LINE\LINEBot\MessageBuilder\Flex\ContainerBuilder\CarouselContainerBuilder;
use LINE\LINEBot\KitchenSink\EventHandler\MessageHandler;
use LINE\LINEBot\Event\MessageEvent;
use LINE\LINEBot\Event\MessageEvent\TextMessage;
use LINE\LINEBot\KitchenSink\EventHandler\MessageHandler\TextMessageHandler;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ButtonTemplateBuilder;
use LINE\LINEBot\TemplateActionBuilder\UriTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\PostbackTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder;
use LINE\LINEBot\MessageBuilder\TemplateMessageBuilder;
use LINE\LINEBot\MessageBuilder\MultiMessageBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ConfirmTemplateBuilder;

class CallbackController extends Controller
{
    /**
     * @param Request $request
     * @param Logger $logger
     */
    public function index(Request $request, Logger $logger)
    {
        $httpClient = new CurlHTTPClient(env('CHANNEL_ACCESS_TOKEN'));
        $bot        = new LINEBot($httpClient, ['channelSecret' => env('CHANNEL_SECRET')]);

        $signature = $request->header(HTTPHeader::LINE_SIGNATURE);
        $events    = $bot->parseEventRequest($request->getContent(), $signature);

        foreach ($events as $event) {
            $token = $event->getReplyToken();
            $bot->replyText($token, "userId {$event->getUserId()}");

            $yes_post        = new PostbackTemplateActionBuilder("はい", "page={$page}");
            $no_post         = new PostbackTemplateActionBuilder("いいえ", "page=-1");
            $confirm         = new ConfirmTemplateBuilder("メッセージ", [$yes_post, $no_post]);
            $confirm_message = new TemplateMessageBuilder("メッセージのタイトル", $confirm);
            $bot->replyMessage($token, $confirm_message);

        }
    }
}
