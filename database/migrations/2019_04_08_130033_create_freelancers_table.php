<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFreelancersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('freelancers', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('user_id')->index();
            $table->string('name')->nullable();
            $table->string('family')->nullable();
            $table->string('meli')->nullable();
            $table->string('mobile')->nullable();
            $table->date('birth')->nullable();
            $table->dateTime('activation')->nullable();
            $table->timestamps();
            $table->primary('id');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('freelancers');
    }
}
