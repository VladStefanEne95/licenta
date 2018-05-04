<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRescuetimeStatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rescue_time', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->float('procent_productivity');
            $table->float('productivity');
            $table->float('procent_social_media');
            $table->float('social_media');
            $table->float('procent_entertainment');
            $table->float('entertainment');
            $table->float('procent_time_pc');
            $table->float('time_pc');
            $table->date('day');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
