<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InventoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('inventories')->insert([
            'inventory_id' => 1,
            'inventory_group_id' => 1,
            'user_id' => 1,
            'name' => 'hoge',
            'count' => 1,
        ]);
        factory(\Zaikok\Inventory::class, 10)->create();
    }
}
