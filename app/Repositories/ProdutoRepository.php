<?php

namespace App\Repositories;
use Illuminate\Http\Request;

interface ProdutoRepository{
    public function query(Request $request);
    public function getAll();
    public function find($id);
}
