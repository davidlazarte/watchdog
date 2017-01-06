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
            $table->string('type')->comment('The type of the event');
            $table->string('message')->comment('The message for the event');
            $table->integer('watchdog_level_id')->unsigned()->comment('The event level');
            $table->text('variable')->comment('Context data in serialized format');
            $table->integer('user_id')->unsigned()->nullable()->comment('User who performed the event');
            $table->string('ip_address', 20)->comment('The client ip of the user');
            $table->timestamp('incident_time')->comment('When the incident happened');
        });

        Schema::create('watchdog_levels', function (Blueprint $table) {
            $table->increments('id')->comment('Unique identifier');
            $table->string('level')->comment('The name of the level');
        });

        $levels = [
            'emergency',
            'alert',
            'critical',
            'error',
            'warning',
            'notice',
            'info',
            'debug',
        ];

        foreach ($levels as $name)
        {
            $level = \davidlazarte\Watchdog\WatchdogLevel::create([
                'name' => $name,
            ]);
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('watchdog');
        Schema::drop('watchdog_levels');
    }
}
