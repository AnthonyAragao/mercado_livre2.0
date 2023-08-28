<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Produto;
use App\Models\Produtor_has_produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProdutoController extends Controller{
    private $produtos, $pivo;
    public function __construct(Produto $produtos, Produtor_has_produto $pivo){
        $this->produtos = $produtos;
        $this->pivo = $pivo;

        $this->categorias = Categoria::all();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        $categorias = $this->categorias;

        return view('produto.form_produto', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $pivo = $this->pivo->create([
            'produtor_id' => Auth::user()->produtor->first()->id,

            'produto_id' => $this->produtos->create([
                'nome' => $request->nome,
                'preco' => $request->preco,
                'descricao' => $request->descricao,
                'estoque' => $request->estoque,
                'categoria_id' => $request->categoria,
            ])->id,
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
