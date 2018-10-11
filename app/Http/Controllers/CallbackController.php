<?php

namespace Zaikok\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use LINE\LINEBot;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;

class CallbackController extends Controller
{
    /**
     * @param Request $request
     * @throws \Throwable
     */
    public function index(Request $request)
    {
        $httpClient = new CurlHTTPClient(env('CHANNEL_ACCESS_TOKEN'));
        $bot        = new LINEBot($httpClient, ['channelSecret' => env('CHANNEL_SECRET')]);

        $signature = $request->header(LINEBot\Constant\HTTPHeader::LINE_SIGNATURE);
        $events    = $bot->parseEventRequest($request->getContent(), $signature);

        /** @var LINEBot\Event\MessageEvent\TextMessage $event */
        foreach ($events as $event) {
            $msg = $event->getText();

            if ('hoge' === $msg) {
                $bot->replyText($event->getReplyToken(), 'ok');
            } else {
                $bot->replyText($event->getReplyToken(), 'ng');
            }
        }
    }
}
