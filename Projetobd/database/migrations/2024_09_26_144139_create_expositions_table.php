<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpositionsTable extends Migration
{

    public function up()
    {
        Schema::create('expositions', function (Blueprint $table) {
            $table->id();
            $table->string('gallery');
            $table->string('theme');
            $table->date('date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('expositions');
    }
}