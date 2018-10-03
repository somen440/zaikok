<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InventoryControlLogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\Zaikok\InventoryControlLog::class, 100)->create();
    }
}
