<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('cus_usr_id')->index();
            $table->uuid('cus_wal_id')->index()->default(0)->nullable();
            $table->string('cus_name')->nullable();
            $table->string('cus_family')->nullable();
            $table->string('cus_display_name')->nullable();
            $table->string('cus_mobile')->nullable();
            $table->timestamps();
            $table->primary('id');

            $table->foreign('cus_usr_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('cus_wal_id')->references('id')->on('wallet')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
