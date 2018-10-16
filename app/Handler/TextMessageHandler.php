<?php

namespace Zaikok\Handler;

use Faker\Provider\ar_JO\Text;
use Illuminate\Database\Eloquent\Collection;
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
                $messages[] = self::inventoriesList($textMessage);
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

            case 'add':
                $user = User::where('line_user_id', intval($identifier))->first();
                if ($user instanceof User) {
                    $nextInventoryId = Inventory::where('user_id', $user->user_id)->lastInventoryId(3)->first()->inventory_id + 1;
                    Inventory::create([
                        'inventory_id'       => $nextInventoryId,
                        'inventory_group_id' => 3,
                        'user_id'            => $user->user_id,
                        'name'               => $identifier,
                        'count'              => 0,
                    ]);
                } else {
                    return new TextMessageBuilder('認証しようず');
                }
                break;

            default:
                return new TextMessageBuilder("{$command} は知らないんです。ごめんね。");
        }
    }

    private static function inventoriesList(TextMessage $textMessage)
    {
        $user = User::where('line_id', $textMessage->getUserId())->first();
        if (is_null($user)) {
            return new TextMessageBuilder('ログインしてないユーザーみたいだよ。');
        }

        /** @var Collection $inventories */
        // todo: グループ固定は後で直す
        $inventories = Inventory::where('inventory_group_id', 3)->where('user_id', $user->user_id)->get();
        if (0 === $inventories->count()) {
            return new TextMessageBuilder('在庫のないグループみたいだよ。');
        }

        $columns = [];

        /** @var Inventory $inventory */
        foreach ($inventories as $inventory) {
            $plusPost   = new PostbackTemplateActionBuilder('＋', 'increment' . '?' . $inventory->id);
            $minusPost  = new PostbackTemplateActionBuilder('ー', 'decrement' . '?' . $inventory->id);
            $deletePost = new PostbackTemplateActionBuilder('削除', 'delete' . '?' . $inventory->id);
            $columns[]  = new CarouselColumnTemplateBuilder(
                $inventory->name,
                "個数: $inventory->count",
                'https://wired.jp/wp-content/uploads/2018/01/GettyImages-522585140.jpg',
                [$plusPost, $minusPost, $deletePost]
            );
        }
        $carousel   = new CarouselTemplateBuilder($columns);
        return new TemplateMessageBuilder("ゴリラーズ", $carousel);
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
