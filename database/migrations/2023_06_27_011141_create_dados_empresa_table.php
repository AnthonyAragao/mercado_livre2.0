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
        Schema::create('dados_empresa', function (Blueprint $table) {
            $table->id();
            $table->string('nome')->nullable();
            $table->string('razao_empresa');
            $table->string('email');
            $table->string('cnpj')->unique();
            $table->string('telefone');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dados_empresa');
    }
};
