<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMinistryScheduleChoirMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ministry_schedule_choir_member', function (Blueprint $table) {
            // $table->id();
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
        Schema::dropIfExists('ministry_schedule_choir_member');
    }
}
