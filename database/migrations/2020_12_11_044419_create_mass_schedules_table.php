<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMassSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mass_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->index();
            $table->dateTime('schedule_time');
            $table->string('mass_title');
            $table->integer('is_daily_mass')->default('1');
            $table->string('entrance_song')->nullable();
            $table->string('psalm_song')->nullable();
            $table->string('alleluia_song')->nullable();
            $table->string('offertory_song')->nullable();
            $table->string('communion_song')->nullable();
            $table->string('song_of_praise')->nullable();
            $table->string('recessional_song')->nullable();

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
        Schema::dropIfExists('mass_schedules');
    }
}
