<?php

use Illuminate\Database\Migrations\Migration;

class AlterUsers12 extends Migration
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
  CHANGE `bearer_token` `bearer_token` varchar(255) NOT NULL COMMENT '';
SQL;
        DB::statement($sql);
    }
}

