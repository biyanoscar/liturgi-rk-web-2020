<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdditionalSongsToMassSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mass_schedules', function (Blueprint $table) {
            $table->tinyInteger('has_additional_songs')->default('0');
            $table->tinyInteger('has_additional_reading')->default('0');

            $table->string('song_01_notes')->nullable();
            $table->unsignedBigInteger('song_01_id')->nullable();
            $table->string('song_02_notes')->nullable();
            $table->unsignedBigInteger('song_02_id')->nullable();
            $table->string('song_03_notes')->nullable();
            $table->unsignedBigInteger('song_03_id')->nullable();
            $table->string('song_04_notes')->nullable();
            $table->unsignedBigInteger('song_04_id')->nullable();
            $table->string('song_05_notes')->nullable();
            $table->unsignedBigInteger('song_05_id')->nullable();

            $table->string('reading_01_notes')->nullable();
            $table->string('reading_01')->nullable();
            $table->string('reading_02_notes')->nullable();
            $table->string('reading_02')->nullable();
            $table->string('reading_03_notes')->nullable();
            $table->string('reading_03')->nullable();
            $table->string('reading_04_notes')->nullable();
            $table->string('reading_04')->nullable();
            $table->string('reading_05_notes')->nullable();
            $table->string('reading_05')->nullable();

            $table->foreign('song_01_id')->references('id')->on('songs')->onDelete('cascade');
            $table->foreign('song_02_id')->references('id')->on('songs')->onDelete('cascade');
            $table->foreign('song_03_id')->references('id')->on('songs')->onDelete('cascade');
            $table->foreign('song_04_id')->references('id')->on('songs')->onDelete('cascade');
            $table->foreign('song_05_id')->references('id')->on('songs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mass_schedules', function (Blueprint $table) {
            $table->dropForeign(['song_01_id']);
            $table->dropForeign(['song_02_id']);
            $table->dropForeign(['song_03_id']);
            $table->dropForeign(['song_04_id']);
            $table->dropForeign(['song_05_id']);
            $table->dropColumn(['has_additional_songs', 'has_additional_reading', 'song_01_notes', 'song_02_notes', 'song_03_notes', 'song_04_notes', 'song_05_notes', 'song_01_id', 'song_02_id', 'song_03_id', 'song_04_id', 'song_05_id', 'reading_01', 'reading_02', 'reading_03', 'reading_04', 'reading_05']);
        });
    }
}
