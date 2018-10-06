<?php

use Illuminate\Database\Migrations\Migration;

class DropOauthAuthCodes10 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = <<<SQL
DROP TABLE `oauth_auth_codes`;
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
CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) NOT NULL COMMENT '',
  `user_id` int(11) NOT NULL COMMENT '',
  `client_id` int(11) NOT NULL COMMENT '',
  `scopes` text COMMENT '',
  `revoked` tinyint(1) NOT NULL COMMENT '',
  `expires_at` datetime COMMENT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='';
SQL;
        DB::statement($sql);
    }
}

