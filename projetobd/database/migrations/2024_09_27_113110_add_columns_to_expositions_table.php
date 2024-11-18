<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToExpositionsTable extends Migration
{
    public function up()
    {
        Schema::table('expositions', function (Blueprint $table) {
            if (!Schema::hasColumn('expositions', 'gallery_type')) {
                $table->string('gallery_type')->nullable();
            }
            if (!Schema::hasColumn('expositions', 'gallery_name')) {
                $table->string('gallery_name')->nullable();
            }
            if (!Schema::hasColumn('expositions', 'gallery_address')) {
                $table->string('gallery_address')->nullable();
            }
            if (!Schema::hasColumn('expositions', 'gallery_city_state')) {
                $table->string('gallery_city_state')->nullable();
            }
            if (!Schema::hasColumn('expositions', 'gallery_country')) {
                $table->string('gallery_country')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('expositions', function (Blueprint $table) {
            $table->dropColumn('gallery_type');
            $table->dropColumn('gallery_name');
            $table->dropColumn('gallery_address');
            $table->dropColumn('gallery_city_state');
            $table->dropColumn('gallery_country');
        });
    }
}