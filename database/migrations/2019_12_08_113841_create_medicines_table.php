<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicinesTable extends Migration
{
    public function up()
    {
        Schema::create('medicines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->integer('quantity');
            $table->enum('measure',['kg','mg','dg','g','hg','cg']);

            $table->bigInteger('type_medicine_id')->unsigned(); #tipos de medicinas
            $table->foreign('type_medicine_id')
                  ->references('id')
                  ->on('type_medicines')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('medicines');
    }
}
