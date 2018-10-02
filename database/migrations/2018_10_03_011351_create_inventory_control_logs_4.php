<?php

use Illuminate\Database\Migrations\Migration;

class CreateInventoryControlLogs4 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = <<<SQL
CREATE TABLE `inventory_control_logs` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '',
  `inventory_id` int(10) UNSIGNED NOT NULL COMMENT '',
  `user_id` int(10) UNSIGNED NOT NULL COMMENT '',
  `name` varchar(255) NOT NULL COMMENT '',
  `count` tinyint(3) UNSIGNED NOT NULL COMMENT '',
  `created_at` timestamp COMMENT '',
  `updated_at` timestamp COMMENT '',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='';
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
DROP TABLE `inventory_control_logs`;
SQL;
        DB::statement($sql);
    }
}

