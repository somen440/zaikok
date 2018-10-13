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
use LINE\LINEBot\Event\PostbackEvent;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselColumnTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselTemplateBuilder;
use LINE\LINEBot\MessageBuilder\Flex\ContainerBuilder\BubbleContainerBuilder;
use LINE\LINEBot\MessageBuilder\Flex\ComponentBuilder\BoxComponentBuilder;

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
            $messages = [];
            $token    = $event->getReplyToken();

            switch (true) {
                case $event instanceof MessageEvent:
                    $plusPost   = new PostbackTemplateActionBuilder('＋', 'plus');
                    $minusPost  = new PostbackTemplateActionBuilder('ー', 'minus');
                    $carousel   = new CarouselTemplateBuilder([
                        self::createItemBubble(),
                    ]);
                    $messages[] = new TemplateMessageBuilder('タイトル', $carousel);
                    break;

                case $event instanceof PostbackEvent:
                    $messages[] = new TextMessageBuilder('ポストがきたよ');
                    break;

                default:
                    continue;
            }

            $multiMessage = new MultiMessageBuilder;
            foreach ($messages as $message) {
                $multiMessage->add($message);
            }

            $bot->replyMessage($token, $multiMessage);
        }
    }

    private static function createItemBubble()
    {
        return BubbleContainerBuilder::builder()
            ->setHero(null)
            ->setBody(null)
            ->setFooter(
                BoxComponentBuilder::builder()
            );
    }
}
