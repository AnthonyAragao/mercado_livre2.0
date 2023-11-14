<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('status_avaliacoes')->insert([
            'nome' => 'Ruim',
        ]);

        DB::table('status_avaliacoes')->insert([
            'nome' => 'Regular',
        ]);

        DB::table('status_avaliacoes')->insert([
            'nome' => 'Bom',
        ]);

        DB::table('status_avaliacoes')->insert([
            'nome' => 'Muito Bom',
        ]);

        DB::table('status_avaliacoes')->insert([
            'nome' => 'Excelente',
        ]);

    }
}
