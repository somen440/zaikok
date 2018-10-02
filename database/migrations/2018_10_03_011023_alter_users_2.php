<?php

use Illuminate\Database\Migrations\Migration;

class AlterUsers2 extends Migration
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
  DROP PRIMARY KEY,
  CHANGE `id` `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  ADD PRIMARY KEY (`user_id`);
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
  DROP PRIMARY KEY,
  CHANGE `user_id` `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  ADD PRIMARY KEY (`id`);
SQL;
        DB::statement($sql);
    }
}

