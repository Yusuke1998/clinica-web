<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeopleTable extends Migration
{
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('firstname'); #primer nombre
            $table->string('middlename')->nullable(); #segundo nombre
            $table->string('firstlastname'); #primer apellido
            $table->string('middlelastname')->nullable(); #segundo apellido
            $table->string('nro_document')->unique();
            $table->enum('gender',['m','f']);
            $table->string('img_document')
                ->default('documents/default.png');
            $table->date('birthday')->nullable();
            $table->string('direction')->nullable();
            $table->string('local_phone')->nullable();
            $table->string('movil_phone')->nullable();
            $table->string('mail_contact')->nullable();

            $table->bigInteger('document_id')->unsigned(); #documento
            $table->foreign('document_id')
                  ->references('id')
                  ->on('documents')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->bigInteger('ethnic_id')->unsigned()->nullable(); #etnia
            $table->foreign('ethnic_id')
                  ->references('id')
                  ->on('ethnics')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('people');
    }
}
