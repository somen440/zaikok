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
    private const PLUS = 1;
    private const MINUS = 2;

    private const TYPE_STRING_MAP = [
        self::PLUS => '加算',
        self::MINUS => '減算',
    ];

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
                    $columns = [];
                    foreach (range(1, 5) as $id) {
                        $plusPost   = new PostbackTemplateActionBuilder('＋', self::PLUS . '?' . $id);
                        $minusPost  = new PostbackTemplateActionBuilder('ー', self::MINUS . '?' . $id);
                        $columns[] = new CarouselColumnTemplateBuilder(
                            "ゴリラの $id くん",
                            '詳細',
                            'https://wired.jp/wp-content/uploads/2018/01/GettyImages-522585140.jpg',
                            [$plusPost, $minusPost]
                        );
                    }
                    $carousel   = new CarouselTemplateBuilder($columns);
                    $messages[] = new TemplateMessageBuilder("ゴリラーズ", $carousel);
                    break;

                case $event instanceof PostbackEvent:
                    [$type, $id] = explode('?', $event->getPostbackData());
                    $messages[] = new TextMessageBuilder(sprintf(
                        'ゴリラの %s くんを %s （気持ち）したよ。',
                        $id,
                        self::TYPE_STRING_MAP[$type]
                    ));
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
}
