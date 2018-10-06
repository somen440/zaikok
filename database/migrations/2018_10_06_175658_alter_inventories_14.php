<?php

use Illuminate\Database\Migrations\Migration;

class AlterInventories14 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = <<<SQL
ALTER TABLE `inventories`
  DROP INDEX `inventory_group_id_inventory_id`,
  ADD UNIQUE `inventory_group_id_inventory_id` (`inventory_group_id`, `inventory_id`, `user_id`);
SQL;
        DB::statement($sql);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $sql = <<<SQL
ALTER TABLE `inventories`
  DROP INDEX `inventory_group_id_inventory_id`,
  ADD UNIQUE `inventory_group_id_inventory_id` (`inventory_group_id`, `inventory_id`);
SQL;
        DB::statement($sql);
    }
}

