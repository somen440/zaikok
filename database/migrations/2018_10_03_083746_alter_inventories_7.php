<?php

use Illuminate\Database\Migrations\Migration;

class AlterInventories7 extends Migration
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
  CHANGE `id` `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '';
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
  CHANGE `id` `id` int(10) UNSIGNED NOT NULL COMMENT '';
SQL;
        DB::statement($sql);
    }
}

