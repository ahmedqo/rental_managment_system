<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property');
            $table->string('name');
            $table->string('nationality');
            $table->string('email');
            $table->string('phone');
            $table->date('startDate');
            $table->date('endDate');
            $table->string('socialNumber');
            $table->string('address');
            $table->json('extra')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->float('price')->default(0);
            $table->timestamps();

            $table->foreign('property')->references('id')->on('properties')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
