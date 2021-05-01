<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMinistrySchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ministry_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mass_schedule_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('choir_id')->constrained();
            $table->foreignId('organist_id')->constrained();
            $table->foreignId('lector_id')->constrained();
            $table->unsignedBigInteger('lector2_id');
            $table->foreign('lector2_id')->references('id')->on('lectors');
            $table->foreignId('psalmist_id')->constrained();

            $table->foreignId('eucharistic_ministry_id')->constrained();
            $table->unsignedBigInteger('eucharistic_ministry2_id');
            $table->foreign('eucharistic_ministry2_id')->references('id')->on('eucharistic_ministries');
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
        Schema::dropIfExists('ministry_schedules');
    }
}
