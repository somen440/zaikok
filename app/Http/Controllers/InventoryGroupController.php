<?php

namespace Zaikok\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Zaikok\InventoryGroup;

/**
 * Class InventoryGroupController
 * @package Zaikok\Http\Controllers
 */
class InventoryGroupController extends Controller
{
    /**
     * @param Request $request
     * @return Collection
     */
    public function getList(Request $request): Collection
    {
        return InventoryGroup::where('user_id', $request->user()->user_id)->get()->keyBy('inventory_group_id');
    }

    /**
     * @param Request $request
     */
    public function create(Request $request): void
    {
        InventoryGroup::create($request->all());
    }

    /**
     * @param Request $request
     * @param int $id
     */
    public function edit(Request $request, int $id): void
    {
        InventoryGroup::find($id)->update($request->all());
    }

    /**
     * @param int $id
     */
    public function delete(int $id): void
    {
        InventoryGroup::find($id)->delete();
    }
}
