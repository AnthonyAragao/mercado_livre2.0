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
        Schema::create('produtores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dados_acesso_id')->constrained('dados_acesso');
            $table->foreignId('dados_empresa_id')->constrained('dados_empresa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtores');
    }
};
