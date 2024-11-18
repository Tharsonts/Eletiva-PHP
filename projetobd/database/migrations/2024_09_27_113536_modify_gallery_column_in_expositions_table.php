<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyGalleryColumnInExpositionsTable extends Migration
{
    public function up()
    {
        Schema::table('expositions', function (Blueprint $table) {
            $table->string('gallery')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('expositions', function (Blueprint $table) {
            $table->string('gallery')->nullable(false)->change();
        });
    }
}