<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('artists', function (Blueprint $table) {
            $table->string('artist_category')->nullable()->change(); // Permite valores nulos
        });
    }
    
    public function down()
    {
        Schema::table('artists', function (Blueprint $table) {
            $table->string('artist_category')->nullable(false)->change(); // Volta ao estado original
        });
    }
};
