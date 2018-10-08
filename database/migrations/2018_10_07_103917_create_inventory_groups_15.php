<?php

use Illuminate\Database\Migrations\Migration;

class CreateInventoryGroups15 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = <<<SQL
CREATE TABLE `inventory_groups` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `inventory_group_id` int(10) UNSIGNED NOT NULL COMMENT '',
  `user_id` int(10) UNSIGNED NOT NULL COMMENT '',
  `name` varchar(255) NOT NULL COMMENT '',
  `created_at` timestamp DEFAULT NULL COMMENT '',
  `updated_at` timestamp DEFAULT NULL COMMENT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `inventory_group_id_user_id` (`inventory_group_id`, `user_id`)
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
DROP TABLE `inventory_groups`;
SQL;
        DB::statement($sql);
    }
}

