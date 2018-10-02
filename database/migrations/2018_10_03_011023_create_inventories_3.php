<?php

use Illuminate\Database\Migrations\Migration;

class CreateInventories3 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = <<<SQL
CREATE TABLE `inventories` (
  `inventory_id` int(10) UNSIGNED NOT NULL COMMENT '',
  `inventory_group_id` int(10) UNSIGNED NOT NULL COMMENT '',
  `user_id` int(10) UNSIGNED NOT NULL COMMENT '',
  `name` varchar(255) NOT NULL COMMENT '',
  `count` tinyint(3) UNSIGNED NOT NULL COMMENT '',
  `created_at` timestamp COMMENT '',
  `updated_at` timestamp COMMENT '',
  PRIMARY KEY (`inventory_group_id`, `inventory_id`),
  KEY `user_id_inventory_group_id` (`user_id`, `inventory_group_id`)
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
DROP TABLE `inventories`;
SQL;
        DB::statement($sql);
    }
}

