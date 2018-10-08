<?php

use Illuminate\Database\Migrations\Migration;

class AlterUsers14 extends Migration
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
  CHANGE `email` `email` varchar(191) NOT NULL COMMENT '',
  CHANGE `bearer_token` `bearer_token` text NOT NULL COMMENT '';
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
  CHANGE `email` `email` varchar(255) NOT NULL COMMENT '',
  CHANGE `bearer_token` `bearer_token` text COMMENT '';
SQL;
        DB::statement($sql);
    }
}

