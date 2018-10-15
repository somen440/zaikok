<?php

namespace Zaikok\Http\Controllers;

use Illuminate\Http\Request;
use LINE\LINEBot;
use LINE\LINEBot\Constant\HTTPHeader;
use LINE\LINEBot\Event\MessageEvent\ImageMessage;
use LINE\LINEBot\Event\MessageEvent\TextMessage;
use LINE\LINEBot\Event\PostbackEvent;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot\KitchenSink\EventHandler\MessageHandler\ImageMessageHandler;
use Zaikok\Handler\PostbackEventHandler;
use Zaikok\Handler\TextMessageHandler;

class CallbackController extends Controller
{
    public function index(Request $request): void
    {
        $httpClient = new CurlHTTPClient(env('CHANNEL_ACCESS_TOKEN'));
        $bot        = new LINEBot($httpClient, ['channelSecret' => env('CHANNEL_SECRET')]);

        $signature = $request->header(HTTPHeader::LINE_SIGNATURE);
        $events    = $bot->parseEventRequest($request->getContent(), $signature);

        foreach ($events as $event) {
            switch (true) {
                case $event instanceof TextMessage:
                    TextMessageHandler::create($bot, $event)->handle();
                    break;

                case $event instanceof ImageMessage:
                    ImageMessageHandler::create($bot, $event)->handle();
                    break;

                case $event instanceof PostbackEvent:
                    PostbackEventHandler::create($bot, $event)->handle();
                    break;

                default:
                    continue;
            }
        }
    }
}
