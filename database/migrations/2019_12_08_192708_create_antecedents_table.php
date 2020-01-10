<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAntecedentsTable extends Migration
{
    public function up()
    {
        Schema::create('antecedents', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('disease_id')->unsigned(); #enfermedad
            $table->foreign('disease_id')
                  ->references('id')
                  ->on('diseases')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->bigInteger('treatment_id')->unsigned(); #tratamiento
            $table->foreign('treatment_id')
                  ->references('id')
                  ->on('treatments')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->bigInteger('patient_id')->unsigned(); #tratamiento
            $table->foreign('patient_id')
                  ->references('id')
                  ->on('patients')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('antecedents');
    }
}
