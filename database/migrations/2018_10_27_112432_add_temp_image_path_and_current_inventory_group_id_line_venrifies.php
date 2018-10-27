<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTempImagePathAndCurrentInventoryGroupIdLineVenrifies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('line_verifies', function (Blueprint $table) {
            $table->text('temp_image_path')->after('user_id')->nullable();
            $table->unsignedInteger('current_inventory_group_id')->after('temp_image_path')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('line_verifies', function (Blueprint $table) {
            $table->dropColumn('temp_image_path');
            $table->dropColumn('current_inventory_group_id');
        });
    }
}
