<?php

namespace Zaikok\Handler;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use LINE\LINEBot;
use LINE\LINEBot\Event\MessageEvent\TextMessage;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ButtonTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselColumnTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateMessageBuilder;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use LINE\LINEBot\TemplateActionBuilder\PostbackTemplateActionBuilder;
use Zaikok\Action\Line\AddInventoryAction;
use Zaikok\Action\Line\AddInventoryGroupAction;
use Zaikok\Action\Line\LoginAction;
use Zaikok\Inventory;
use Zaikok\InventoryGroup;
use Zaikok\User;

class TextMessageHandler extends AbstractHandler
{
    public static function create(LINEBot $bot, TextMessage $textMessage): self
    {
        $text = $textMessage->getText();
        $messages = [];
        switch (true) {
            case preg_match('/^[a-z]+:.+$/', $text):
                $messages[] = self::commands($textMessage);
                break;

            case 'inventory' === $text:
                $messages[] = self::inventoriesList($textMessage);
                break;

            case 'group' === $text:
                $messages[] = self::groupsList($textMessage);
                break;

            case 'help' === $text:
                $messages[] = new TextMessageBuilder('ヘルプだよ');
                break;

            case 'delete' === $text:
                $messages[] = self::groupsList($textMessage, true);
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

        DB::beginTransaction();
        try {
            switch ($command) {
                case 'login':
                    $message = LoginAction::execute($identifier);
                    break;

                case 'add':
                    $message = AddInventoryAction::execute(
                        User::findByLineId($textMessage->getUserId())->first(),
                        $identifier
                    );
                    break;

                case 'addg':
                    $message = AddInventoryGroupAction::execute(
                        User::findByLineId($textMessage->getUserId())->first(),
                        $identifier
                    );
                    break;

                default:
                    $message = new TextMessageBuilder("{$command} は知らないんです。ごめんね。");
            }

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }

        return $message;
    }

    private static function inventoriesList(TextMessage $textMessage)
    {
        $user = User::where('line_id', $textMessage->getUserId())->first();
        if (is_null($user)) {
            return new TextMessageBuilder('ログインしてないユーザーみたいだよ。');
        }

        /** @var Collection $inventories */
        $inventories = Inventory::where('inventory_group_id', $user->current_inventory_group_id)->where('user_id', $user->user_id)->get();
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
                is_null($inventory->image_path)
                    ? 'https://wired.jp/wp-content/uploads/2018/01/GettyImages-522585140.jpg'
                    : asset(Storage::url($inventory->image_path))
                ,
                [$plusPost, $minusPost, $deletePost]
            );
        }
        $carousel   = new CarouselTemplateBuilder($columns);
        return new TemplateMessageBuilder("ゴリラーズ", $carousel);
    }

    private static function groupsList(TextMessage $textMessage, bool $isDelete = false)
    {
        $user = User::where('line_id', $textMessage->getUserId())->first();
        if (is_null($user)) {
            return new TextMessageBuilder('ログインしてないユーザーみたいだよ。');
        }

        $groupButtons = [];
        $inventoryGroups = InventoryGroup::where('user_id', $user->user_id)->get();
        foreach ($inventoryGroups as $inventoryGroup) {
            $groupButtons[] = new PostbackTemplateActionBuilder(
                $inventoryGroup->name,
                $isDelete
                    ? 'delete-group?' . $inventoryGroup->id
                    : 'group?' . $inventoryGroup->inventory_group_id
            );
        }

        $buttonTemplateBuilder = new ButtonTemplateBuilder(
            'グループ一覧',
            $isDelete ? 'タップしたグループを削除できるよ' : 'グループをタップで切り替えられるよ',
            $isDelete ? asset('images/trash.jpg') : asset('images/menu.jpg'),
            $groupButtons
        );
        return new TemplateMessageBuilder('Button alt text', $buttonTemplateBuilder);
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
