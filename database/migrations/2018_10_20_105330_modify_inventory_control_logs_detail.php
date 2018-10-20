<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyInventoryControlLogsDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inventory_control_logs', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->dropColumn('inventory_group_id');
            $table->dropColumn('inventory_id');
            $table->dropColumn('count');
            $table->json('detail')->after('log_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inventory_control_logs', function (Blueprint $table) {
            $table->dropColumn('detail');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('inventory_group_id');
            $table->unsignedInteger('inventory_id');
            $table->unsignedTinyInteger('count');
        });
    }
}
