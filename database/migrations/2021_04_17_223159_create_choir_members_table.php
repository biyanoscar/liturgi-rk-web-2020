<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChoirMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('choir_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('choir_id')->constrained()->onDelete('cascade');
            $table->string('name')->unique();
            $table->string('no_kk');
            $table->integer('is_default')->default('1');
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
        Schema::dropIfExists('choir_members');
    }
}
