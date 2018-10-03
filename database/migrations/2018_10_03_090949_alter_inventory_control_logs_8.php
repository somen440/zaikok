<?php

use Illuminate\Database\Migrations\Migration;

class AlterInventoryControlLogs8 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = <<<SQL
ALTER TABLE `inventory_control_logs`
  CHANGE `id` `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  CHANGE `count` `count` tinyint(3) NOT NULL COMMENT '';
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
ALTER TABLE `inventory_control_logs`
  CHANGE `id` `id` int(10) UNSIGNED NOT NULL COMMENT '',
  CHANGE `count` `count` tinyint(3) UNSIGNED NOT NULL COMMENT '';
SQL;
        DB::statement($sql);
    }
}

