<?php

namespace Zaikok\Handler;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use LINE\LINEBot;
use LINE\LINEBot\Event\MessageEvent\TextMessage;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselColumnTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateMessageBuilder;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use LINE\LINEBot\TemplateActionBuilder\PostbackTemplateActionBuilder;
use Zaikok\Inventory;
use Zaikok\User;

class TextMessageHandler extends AbstractHandler
{
    public static function create(LINEBot $bot, TextMessage $textMessage): self
    {
        $text = $textMessage->getText();
        $messages = [];
        switch (true) {
            case preg_match('/^[a-z]+:[0-9]+$/', $text):
                $messages[] = self::commands($textMessage);
                break;

            case '在庫リスト':
                break;

            case 'ゴリラ' === $text:
                $messages[] = self::gorilla();
                break;

            default:
                $messages[] = new TextMessageBuilder("$text は知らないことばゴリ");
        };
        return new self($bot, $textMessage->getReplyToken(), $messages);
    }

    private static function commands(TextMessage $textMessage): TextMessageBuilder
    {
        $text = $textMessage->getText();
        [$command, $identifier] = explode(':', $text);
        switch ($command) {
            case 'login':
                $user = User::where('line_verify_token', intval($identifier))->first();
                if ($user instanceof User) {
                    DB::beginTransaction();
                    try {
                        $user->line_verify_token = null;
                        $user->line_id = $textMessage->getUserId();
                        $user->saveOrFail();
                        DB::commit();
                    } catch (\Throwable $e) {
                        DB::rollBack();
                        Log::error($e->getMessage());
                        throw $e;
                    }
                    return new TextMessageBuilder("ようこそ {$user->name} さん !!");
                } else {
                    return new TextMessageBuilder("{$identifier} のユーザー見つからん。。。もう一回やって？");
                }
                break;

            default:
                return new TextMessageBuilder("{$command} は知らないんです。ごめんね。");
        }
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
