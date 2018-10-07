<?php

use Illuminate\Database\Migrations\Migration;

class AlterUsers11 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = <<<SQL
ALTER TABLE `users`
  ADD COLUMN `bearer_token` varchar(255) NOT NULL COMMENT '' AFTER `remember_token`;
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
ALTER TABLE `users`
  DROP COLUMN `bearer_token`;
SQL;
        DB::statement($sql);
    }
}

