<?php

use Illuminate\Database\Migrations\Migration;

class AlterInventoryControlLogs6 extends Migration
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
  CHANGE `name` `type` tinyint(3) UNSIGNED NOT NULL COMMENT '';
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
  CHANGE `type` `name` varchar(255) NOT NULL COMMENT '';
SQL;
        DB::statement($sql);
    }
}

