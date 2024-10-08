<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::table('artists', function (Blueprint $table) {
            $table->string('artistic_styles')->nullable();
            $table->text('biography')->nullable(); // Exemplo de campo de seleção múltipla
            $table->string('image_path')->nullable(); // Para armazenar o caminho da imagem
        });
    }


    public function down(): void
    {
        Schema::table('artists', function (Blueprint $table) {
            //
        });
    }
};
