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
        Schema::create('produtor_has_produto', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produtor_id')->constrained('produtores');
            $table->foreignId('produto_id')->constrained('produtos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtor_has_produto');
    }
};
