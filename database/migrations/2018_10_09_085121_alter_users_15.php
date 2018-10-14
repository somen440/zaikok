<?php

use Illuminate\Database\Migrations\Migration;

class AlterUsers15 extends Migration
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
  CHANGE `bearer_token` `bearer_token` text COMMENT '';
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
    }
}
