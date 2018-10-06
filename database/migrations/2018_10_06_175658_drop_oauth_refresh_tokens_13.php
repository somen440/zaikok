<?php

use Illuminate\Database\Migrations\Migration;

class DropOauthRefreshTokens13 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = <<<SQL
DROP TABLE `oauth_refresh_tokens`;
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
CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) NOT NULL COMMENT '',
  `access_token_id` varchar(100) NOT NULL COMMENT '',
  `revoked` tinyint(1) NOT NULL COMMENT '',
  `expires_at` datetime COMMENT '',
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='';
SQL;
        DB::statement($sql);
    }
}

