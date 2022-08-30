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
        Schema::create('is_workings', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('isworking');
            $table->string('isprior');
            $table->string('designation')->nullable();
            $table->string('serving')->nullable();
            $table->string('organization_name')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('is_workings');
    }
};