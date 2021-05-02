<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChoirMemberMinistryScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('choir_member_ministry_schedule', function (Blueprint $table) {
            $table->primary(['ministry_schedule_id', 'choir_member_id'], 'ms_cm_id');
            $table->foreignId('ministry_schedule_id', 'ms_id_foreign')->constrained()->onDelete('cascade');
            $table->foreignId('choir_member_id', 'cm_id_foreign')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('choir_member_ministry_schedule');
    }
}
