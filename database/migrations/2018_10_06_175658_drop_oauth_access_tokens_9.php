<?php

use Illuminate\Database\Migrations\Migration;

class DropOauthAccessTokens9 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = <<<SQL
DROP TABLE `oauth_access_tokens`;
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
CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) NOT NULL COMMENT '',
  `user_id` int(11) COMMENT '',
  `client_id` int(11) NOT NULL COMMENT '',
  `name` varchar(255) COMMENT '',
  `scopes` text COMMENT '',
  `revoked` tinyint(1) NOT NULL COMMENT '',
  `created_at` timestamp COMMENT '',
  `updated_at` timestamp COMMENT '',
  `expires_at` datetime COMMENT '',
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='';
SQL;
        DB::statement($sql);
    }
}

