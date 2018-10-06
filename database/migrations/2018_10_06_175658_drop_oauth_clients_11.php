<?php

use Illuminate\Database\Migrations\Migration;

class DropOauthClients11 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = <<<SQL
DROP TABLE `oauth_clients`;
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
CREATE TABLE `oauth_clients` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `user_id` int(11) COMMENT '',
  `name` varchar(255) NOT NULL COMMENT '',
  `secret` varchar(100) NOT NULL COMMENT '',
  `redirect` text NOT NULL COMMENT '',
  `personal_access_client` tinyint(1) NOT NULL COMMENT '',
  `password_client` tinyint(1) NOT NULL COMMENT '',
  `revoked` tinyint(1) NOT NULL COMMENT '',
  `created_at` timestamp COMMENT '',
  `updated_at` timestamp COMMENT '',
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='';
SQL;
        DB::statement($sql);
    }
}

