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
        Schema::create('preferences', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('paper_setter');
            $table->string('interview');
            $table->string('line_1');
            $table->string('line_2');
            $table->string('pincode');
            $table->string('state');
            $table->string('district');
            $table->string('brief')->nullable();
            $table->string('enquiry');
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
        Schema::dropIfExists('preferences');
    }
};