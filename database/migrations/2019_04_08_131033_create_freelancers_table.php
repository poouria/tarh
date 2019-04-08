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
            $table->uuid('frc_usr_id')->index();
            $table->uuid('frc_wal_id')->index()->default(0)->nullable();
            $table->uuid('frc_auth_id')->index()->default(0)->nullable();
            $table->string('frc_name')->nullable();
            $table->string('frc_family')->nullable();
            $table->string('frc_meli')->nullable();
            $table->string('frc_birth')->nullable();
            $table->boolean('frc_activation')->default(0);
            $table->timestamps();
            $table->primary('id');

            $table->foreign('frc_usr_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('frc_wal_id')->references('id')->on('wallet')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('frc_auth_id')->references('id')->on('authorization')->onDelete('set null')->onUpdate('cascade');
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
