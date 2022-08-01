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
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('isworking');
            $table->string('designation');
            $table->string('serving');
            $table->string('type');
            $table->string('year');
            $table->string('specify')->nullable();
            $table->string('org_type');
            $table->string('org_name');
            $table->string('org_year');
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
        Schema::dropIfExists('experiences');
    }
};