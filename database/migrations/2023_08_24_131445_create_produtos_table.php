<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('imagem_01');
            $table->string('imagem_02')->nullable();
            $table->string('imagem_03')->nullable();
            $table->string('imagem_04')->nullable();
            $table->string('imagem_05')->nullable();
            $table->float('preco');
            $table->string('descricao');
            $table->integer('estoque');
            $table->integer('desconto')->nullable();
            $table->foreignId('categoria_id')->constrained('categorias');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
