<?php

namespace Zaikok\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Zaikok\Inventory;

class InventoryController extends Controller
{
    /**
     * @param Request $request
     * @param int $inventoryGroupId
     * @return Collection <Inventory>
     */
    public function show(Request $request, int $inventoryGroupId): Collection
    {
        return Inventory::where('user_id', $request->user()->user_id)
            ->where('inventory_group_id', $inventoryGroupId)
            ->orderBy('inventory_id', 'asc')
            ->get()
        ;
    }

    /**
     * @param Request $request
     */
    public function create(Request $request): void
    {
        Inventory::create($request->all());
    }

    /**
     * @param Request $request
     * @param int $id
     */
    public function edit(Request $request, int $id): void
    {
        Inventory::find($id)->update($request->all());
    }

    /**
     * @param int $id
     */
    public function delete(int $id): void
    {
        Inventory::find($id)->delete();
    }

    /**
     * @return void
     */
    public function deleteAll(): void
    {
        Inventory::truncate();
    }
}
