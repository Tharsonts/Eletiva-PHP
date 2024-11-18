<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('artworks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('technique');
            $table->date('creation_date');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('artworks');
    }
};
