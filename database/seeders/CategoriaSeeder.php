<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categorias')->truncate();
        
        DB::table('categorias')->insert([
            'nome' => 'Carros, Motos e Outros',
        ]);
        DB::table('categorias')->insert([
            'nome' => 'Beleza e Cuidado Pessoal',
        ]);
        DB::table('categorias')->insert([
            'nome' => 'Celulares e Telefones',
        ]);
        DB::table('categorias')->insert([
            'nome' => 'Calçados, Roupas e Bolsas',
        ]);
        DB::table('categorias')->insert([
            'nome' => 'Informática',
        ]);
        DB::table('categorias')->insert([
            'nome' => 'Games',
        ]);
        DB::table('categorias')->insert([
            'nome' => 'Brinquedos e Hobbies',
        ]);
        DB::table('categorias')->insert([
            'nome' => 'Eletrodomésticos',
        ]);
        DB::table('categorias')->insert([
            'nome' => 'Imóveis',
        ]);
        DB::table('categorias')->insert([
            'nome' => 'Instrumentos Musicais',
        ]);
        DB::table('categorias')->insert([
            'nome' => 'Ferramentas',
        ]);
        DB::table('categorias')->insert([
            'nome' => 'Saúde',
        ]);
        DB::table('categorias')->insert([
            'nome' => 'Câmeras e Acessórios',
        ]);
        DB::table('categorias')->insert([
            'nome' => 'Livros, Revistas e Comics',
        ]);
    }
}
