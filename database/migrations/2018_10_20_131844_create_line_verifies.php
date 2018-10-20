<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLineVerifies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('line_verifies', function (Blueprint $table) {
            $table->increments('line_verify_id');
            $table->string('line_id');
            $table->unsignedInteger('user_id');
            $table->timestamps();

            $table->unique(['line_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('line_verifies');
    }
}
