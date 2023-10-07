<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Categoria;
use App\Models\Produto;
use App\Models\Produtor_has_produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

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
    public function index(){
        $produtos = $this->produtos->all();


        return view('welcome', compact('produtos'));
    }

    public function search(Request $request){
        $search = $request->input('query');

        $produtos = $this->produtos
                ->where('nome', 'like' ,'%'.$search.'%')
                ->orWhere('descricao', 'like', '%'. $search . '%')
                ->get();

        return view('welcome', compact('produtos'));
    }

    
    public function indexAuth(){
        $produtor = Auth::user()->produtor[0];
        $produtos = $produtor->produtor_has_produto;


        return view('produtor.meus_produtos', compact('produtor', 'produtos'));
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
                'imagem_01' => Helper::armazenarArquivo($request->imagens[0], 'files/produtos'),
                'imagem_02' => isset($request->imagens[1]) ? Helper::armazenarArquivo($request->imagens[1], 'files/produtos') : null,
                'imagem_03' => isset($request->imagens[2]) ? Helper::armazenarArquivo($request->imagens[2], 'files/produtos') : null,
                'imagem_04' => isset($request->imagens[3]) ? Helper::armazenarArquivo($request->imagens[3], 'files/produtos') : null,
                'imagem_05' => isset($request->imagens[4]) ? Helper::armazenarArquivo($request->imagens[4], 'files/produtos') : null,
                'nome' => $request->nome,
                'preco' => $request->preco,
                'desconto' => $request->desconto,
                'preco_desconto' => $request->preco - (($request->preco * $request->desconto)/100),

                'descricao' => $request->descricao,
                'estoque' => $request->estoque,
                'categoria_id' => $request->categoria,
            ])->id,
        ]);

        $check = 'Produto cadastro com sucesso!';
        return redirect()->route('listagem_produtos')->with('check',$check);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id){
        $produto = $this->produtos->find(Crypt::decrypt($id));
        $produtor = $produto->produtor_has_produto[0]->produtor;

        return view('produto.show_produto', compact('produto', 'produtor'));
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
        $produto = $this->produtos->find(Crypt::decrypt($id));
        $pivo = $produto->produtor_has_produto[0];

        $pivo->delete();
        $produto->delete();

        $check = 'Produto deletado com sucesso!';
        return redirect()->route('produto.indexAuth')->with('check',$check);
    }
}
