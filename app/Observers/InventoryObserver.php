<?php

namespace Zaikok\Observers;

use Illuminate\Support\Facades\Log;
use Zaikok\Inventory;
use Zaikok\InventoryControlLog;

class InventoryObserver
{
    /**
     * Handle the inventory "created" event.
     *
     * @param  \Zaikok\Inventory  $inventory
     * @return void
     */
    public function created(Inventory $inventory)
    {
        InventoryControlLog::create([
            'log_type' => InventoryControlLog::TYPE_ADD,
            'detail'   => json_encode([
                'user_id'            => $inventory->user_id,
                'inventory_group_id' => $inventory->inventory_group_id,
                'inventory_id'       => $inventory->inventory_id,
                'count'              => 0,
            ]),
        ]);
        Log::info('Inventory 作成成功');
    }

    /**
     * Handle the inventory "updated" event.
     *
     * @param  \Zaikok\Inventory  $inventory
     * @return void
     */
    public function updated(Inventory $inventory)
    {
        InventoryControlLog::create([
            'log_type' => InventoryControlLog::TYPE_UPDATE,
            'detail'   => json_encode([
                'user_id'            => $inventory->user_id,
                'inventory_group_id' => $inventory->inventory_group_id,
                'inventory_id'       => $inventory->inventory_id,
                'count'              => $inventory->count,
            ])
        ]);
        Log::info('Inventory 更新成功');
    }

    /**
     * Handle the inventory "deleted" event.
     *
     * @param  \Zaikok\Inventory  $inventory
     * @return void
     */
    public function deleted(Inventory $inventory)
    {
        InventoryControlLog::create([
            'log_type' => InventoryControlLog::TYPE_DELETE,
            'detail'   => json_encode([
                'user_id'      => $inventory->user_id,
                'inventory_id' => $inventory->name,
            ])
        ]);
        Log::info('Inventory 削除成功');
    }

    /**
     * Handle the inventory "restored" event.
     *
     * @param  \Zaikok\Inventory  $inventory
     * @return void
     */
    public function restored(Inventory $inventory)
    {
        //
    }

    /**
     * Handle the inventory "force deleted" event.
     *
     * @param  \Zaikok\Inventory  $inventory
     * @return void
     */
    public function forceDeleted(Inventory $inventory)
    {
        //
    }
}
