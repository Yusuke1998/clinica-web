<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePregnanciesTable extends Migration
{
    public function up()
    {
        Schema::create('pregnancies', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->string('weeks');
            $table->date('fpp'); #fecha de probable parto
            $table->date('fur'); #fecha de ultima regla

            $table->bigInteger('patient_id')->unsigned(); #persona
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
        Schema::dropIfExists('pregnancies');
    }
}
