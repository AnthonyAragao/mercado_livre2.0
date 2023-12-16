<?php

namespace App\Repositories;

use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class EloquentProdutoRepository implements ProdutoRepository{
    // Construtor
    protected $model;
    public function __construct(Produto $model)
    {
        $this->model = $model;
    }

    // Buscar os produtos baseado na query passada
    public function query(Request $request) {
        $search = $request->input('query');

        $produtos = $this->model
                ->where('nome', 'like' ,'%'.$search.'%')
                ->orWhere('descricao', 'like', '%'. $search . '%')
                ->get();

        return $produtos;
    }

    // Pegar todos os Produtos
    public function getAll(){
        return $this->model->all();
    }

    // Retorna o produto pego pelo id
    public function find($id){
        return $this->model->find(Crypt::decrypt($id));
    }

    // Retorna as categorias com seus respectivos icones que vao ser consumidos na view
    public function categoriaComIcones(){
        $categorias = [
            ['id' => 1, 'nome' => 'Carros, Motos e Outros', 'icon' => 'fa-car'],
            ['id' => 2, 'nome' => 'Beleza e Cuidado Pessoal', 'icon' => 'fa-wand-magic-sparkles'],
            ['id' => 3, 'nome' => 'Celulares e Telefones', 'icon' => 'fa-mobile-screen'],
            ['id' => 4, 'nome' => 'Calçados, Roupas e Bolsas', 'icon' => 'fa-shirt'],
            ['id' => 5, 'nome' => 'Informática', 'icon' => 'fa-desktop'],
            ['id' => 6, 'nome' => 'Games', 'icon' => 'fa-gamepad'],
            ['id' => 7, 'nome' => 'Brinquedos e Hobbies', 'icon' => 'fa-spider'],
            ['id' => 8, 'nome' => 'Eletrodomésticos', 'icon' => 'fa-blender-phone'],
            ['id' => 9, 'nome' => 'Imóveis', 'icon' => 'fa-house'],
            ['id' => 10, 'nome' => 'Instrumentos Musicais', 'icon' => 'fa-music'],
            ['id' => 11, 'nome' => 'Ferramentas', 'icon' => 'fa-wrench'],
            ['id' => 12, 'nome' => 'Saúde', 'icon' => 'fa-notes-medical'],
            ['id' => 13, 'nome' => 'Câmeras e Acessórios', 'icon' => 'fa-camera'],
            ['id' => 14, 'nome' => 'Livros, Revistas e Comics', 'icon' => 'fa-book-open'],
        ];

        return $categorias;
    }
}
