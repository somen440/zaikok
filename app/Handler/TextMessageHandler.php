<?php

namespace Zaikok\Handler;

use LINE\LINEBot;
use LINE\LINEBot\Event\MessageEvent\TextMessage;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselColumnTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateMessageBuilder;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use LINE\LINEBot\TemplateActionBuilder\PostbackTemplateActionBuilder;
use Zaikok\Inventory;

class TextMessageHandler extends AbstractHandler
{
    public static function create(LINEBot $bot, TextMessage $textMessage): self
    {
        $messages = [];
        switch ($textMessage->getText()) {
            case 'ゴリラ':
                $messages[] = self::gorilla();
                break;

            default:
                $messages[] = new TextMessageBuilder('知らないことばゴリ');
        };
        return new self($bot, $textMessage->getReplyToken(), $messages);
    }

    private static function gorilla(): TemplateMessageBuilder
    {
        $columns = [];
        foreach (range(1, 5) as $id) {
            $plusPost   = new PostbackTemplateActionBuilder('＋', Inventory::PLUS . '?' . $id);
            $minusPost  = new PostbackTemplateActionBuilder('ー', Inventory::MINUS . '?' . $id);
            $columns[] = new CarouselColumnTemplateBuilder(
                "ゴリラの $id くん",
                '詳細',
                'https://wired.jp/wp-content/uploads/2018/01/GettyImages-522585140.jpg',
                [$plusPost, $minusPost]
            );
        }
        $carousel   = new CarouselTemplateBuilder($columns);
        return new TemplateMessageBuilder("ゴリラーズ", $carousel);
    }
}
