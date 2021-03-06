<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorktimeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('worktime', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('clocked_out');
            $table->integer('clocked_time');
            $table->integer('pause');
            $table->integer('working_seconds');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('worktime');
    }
}
