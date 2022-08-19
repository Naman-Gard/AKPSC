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
        Schema::create('empanelments', function (Blueprint $table) {
            $table->id();
            $table->string('empanelment_id');
            $table->integer('user_id');
            $table->string('file_number');
            $table->string('date_of_empanel');
            $table->string('secret_code1')->nullable();
            $table->string('secret_code2')->nullable();
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
        Schema::dropIfExists('empanelments');
    }
};
