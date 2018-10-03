<?php

use Illuminate\Database\Migrations\Migration;

class AlterInventories5 extends Migration
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
  DROP PRIMARY KEY,
  ADD COLUMN `id` int(10) UNSIGNED NOT NULL COMMENT '' FIRST,
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE `inventory_group_id_inventory_id` (`inventory_group_id`, `inventory_id`);
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
  DROP PRIMARY KEY,
  DROP INDEX `inventory_group_id_inventory_id`,
  DROP COLUMN `id`,
  ADD PRIMARY KEY (`inventory_group_id`, `inventory_id`);
SQL;
        DB::statement($sql);
    }
}

