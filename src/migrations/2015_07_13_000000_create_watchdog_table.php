<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWatchdogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('watchdog', function (Blueprint $table) {
            $table->increments('id')->comment('Unique identifier');
            $table->string('message')->comment('The message for the event');
            $table->string('level', 20)->comment('The event level');
            $table->text('variable')->comment('Context data in serialized format');
            $table->string('user', 100)->comment('User who performed the event');
            $table->string('ip_address', 20)->comment('The client ip of the user');
            $table->timestamp('incident_time')->comment('When the incident happened');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('watchdog');
    }
}
