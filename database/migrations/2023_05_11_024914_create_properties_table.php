<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title')->unique();
            $table->float('normalPrice');
            $table->float('specialPrice');
            $table->float('area');
            $table->integer('rooms');
            $table->tinyInteger('kitchen');
            $table->tinyInteger('garage');
            $table->tinyInteger('garden');
            $table->string('map');
            $table->string('address');
            $table->string('state')->nullable();;
            $table->string('city')->nullable();;
            $table->string('zipcode')->nullable();;
            $table->longText('description')->nullable();
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
        Schema::dropIfExists('properties');
    }
}
