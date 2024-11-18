<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpositionArtworkTable extends Migration
{
    public function up()
    {
        Schema::create('exposition_artwork', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exposition_id')->constrained()->onDelete('cascade');
            $table->foreignId('artwork_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('exposition_artwork');
    }
}

