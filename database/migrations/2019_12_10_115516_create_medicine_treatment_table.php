<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicineTreatmentTable extends Migration
{
    public function up()
    {
        Schema::create('medicine_treatment', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('medicine_id')->unsigned(); #medicamento
            $table->foreign('medicine_id')
                  ->references('id')
                  ->on('medicines')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->bigInteger('treatment_id')->unsigned(); #tratamiento
            $table->foreign('treatment_id')
                  ->references('id')
                  ->on('treatments')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('medicine_treatment');
    }
}
