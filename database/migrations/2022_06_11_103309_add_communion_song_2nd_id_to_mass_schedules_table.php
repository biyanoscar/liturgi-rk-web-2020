<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCommunionSong2ndIdToMassSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mass_schedules', function (Blueprint $table) {
            $table->unsignedBigInteger('communion_song_2nd_id')->nullable()->after('communion_song_id');
            $table->foreign('communion_song_2nd_id')->references('id')->on('songs');
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
            $table->dropForeign(['communion_song_2nd_id']);
            $table->dropColumn('communion_song_2nd_id');
        });
    }
}
