<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewDataToTasks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tasks', function($table){
            $table->integer('high_priority');
            $table->integer('time_tracking');
            $table->integer('planned_time');
            $table->integer('repeat_task');
            $table->text('assigned_to');
            $table->text('observers');
            $table->text('project');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tasks', function($table){
            $table->integer('high_priority');
            $table->integer('time_tracking');
            $table->integer('planned_time');
            $table->integer('repeat_task');
            $table->text('assigned_to');
            $table->text('observers');
            $table->text('project');
        });
    }
}
