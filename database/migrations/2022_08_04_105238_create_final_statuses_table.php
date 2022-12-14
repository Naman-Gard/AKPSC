<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('final_statuses', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('register_id')->unique();
            $table->string('empanelled')->nullable();
            $table->string('blacklisted')->nullable();
            $table->string('appointed')->nullable();
            $table->integer('status');
            $table->string('dor');
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
        Schema::dropIfExists('final_statuses');
    }
};
