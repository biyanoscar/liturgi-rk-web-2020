<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSongIdToMassSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mass_schedules', function (Blueprint $table) {
            $table->string('lords_prayer_song')->nullable();
            $table->unsignedBigInteger('entrance_song_id')->nullable();
            $table->unsignedBigInteger('kyrie_song_id')->nullable();
            $table->unsignedBigInteger('gloria_song_id')->nullable();
            $table->unsignedBigInteger('offertory_song_id')->nullable();
            $table->unsignedBigInteger('sanctus_song_id')->nullable();
            $table->unsignedBigInteger('lords_prayer_song_id')->nullable();
            $table->unsignedBigInteger('agnus_dei_song_id')->nullable();
            $table->unsignedBigInteger('communion_song_id')->nullable();
            $table->unsignedBigInteger('song_of_praise_id')->nullable();
            $table->unsignedBigInteger('recessional_song_id')->nullable();

            $table->foreign('entrance_song_id')->references('id')->on('songs');
            $table->foreign('kyrie_song_id')->references('id')->on('songs');
            $table->foreign('gloria_song_id')->references('id')->on('songs');
            $table->foreign('offertory_song_id')->references('id')->on('songs');
            $table->foreign('sanctus_song_id')->references('id')->on('songs');
            $table->foreign('lords_prayer_song_id')->references('id')->on('songs');
            $table->foreign('agnus_dei_song_id')->references('id')->on('songs');
            $table->foreign('communion_song_id')->references('id')->on('songs');
            $table->foreign('song_of_praise_id')->references('id')->on('songs');
            $table->foreign('recessional_song_id')->references('id')->on('songs');
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
            $table->dropForeign(['entrance_song_id']);
            $table->dropForeign(['kyrie_song_id']);
            $table->dropForeign(['gloria_song_id']);
            $table->dropForeign(['offertory_song_id']);
            $table->dropForeign(['sanctus_song_id']);
            $table->dropForeign(['lords_prayer_song_id']);
            $table->dropForeign(['agnus_dei_song_id']);
            $table->dropForeign(['communion_song_id']);
            $table->dropForeign(['song_of_praise_id']);
            $table->dropForeign(['recessional_song_id']);
            $table->dropColumn(['lords_prayer_song', 'entrance_song_id', 'kyrie_song_id', 'gloria_song_id', 'offertory_song_id', 'sanctus_song_id', 'agnus_dei_song_id', 'communion_song_id', 'song_of_praise_id', 'recessional_song_id']);
        });
    }
}
