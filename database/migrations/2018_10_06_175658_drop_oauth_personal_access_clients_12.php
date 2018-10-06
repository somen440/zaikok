<?php

use Illuminate\Database\Migrations\Migration;

class DropOauthPersonalAccessClients12 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = <<<SQL
DROP TABLE `oauth_personal_access_clients`;
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
CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `client_id` int(11) NOT NULL COMMENT '',
  `created_at` timestamp COMMENT '',
  `updated_at` timestamp COMMENT '',
  PRIMARY KEY (`id`),
  KEY `oauth_personal_access_clients_client_id_index` (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='';
SQL;
        DB::statement($sql);
    }
}

