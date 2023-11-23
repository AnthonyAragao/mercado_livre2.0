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
}
