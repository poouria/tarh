<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auths', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('freelancer_id')->index();

            $table->string('contract')->nullable();
            $table->string('meli_pic')->nullable();
            $table->string('shenasname')->nullable();
            $table->string('detail')->nullable();
            $table->timestamps();
            $table->primary('id');

            $table->foreign('freelancer_id')->references('id')->on('freelancers')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('auths');
    }
}
