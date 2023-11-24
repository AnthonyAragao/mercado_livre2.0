<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Categoria;
use App\Models\Produto;
use App\Models\Produtor_has_produto;
use App\Repositories\ProdutoRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class ProdutoController extends Controller{
    protected $produtos, $pivo, $repository, $categorias;

    public function __construct(Produto $produtos, Produtor_has_produto $pivo, ProdutoRepository $repository){
        $this->produtos = $produtos;
        $this->pivo = $pivo;
        $this->repository = $repository;
        $this->categorias = Categoria::all();
    }
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $produtos = $this->repository->getAll();

        return view('welcome', compact('produtos'));
    }

    public function search(Request $request){
        $produtos = $this->repository->query($request);

        return view('welcome', compact('produtos'));
    }


    public function indexAuth(){
        $produtor = Auth::user()->produtor[0];

        $produtos = Produtor_has_produto::where('produtor_id', $produtor->id)
            ->with(['produtoRelationship'])
            ->get();

        return view('produtor.meus_produtos', compact('produtor', 'produtos'));
    }

    public function categories($id){
        $categoriaProduto = $this->categorias->find(Crypt::decrypt($id));;
        $produtos = $categoriaProduto->produto;

        return view('welcome', compact('produtos'));
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
        $produto = $this->repository->find($id);
        $categoriaProduto = $this->categorias->find($produto->categoria->id );
        $produtosCategoriaAll = $categoriaProduto->produto;

        // Filtrar os produtos para excluir o produto definido na primeira linha
        $produtosCategoria = $produtosCategoriaAll->filter(function($item) use ($produto) {
            return $item->id !== $produto->id;
        });


        $avaliacoes = $produto->avaliacao;
        $produtor = $produto->produtor_has_produto[0]->produtor;

        return view('produto.show_produto', compact('produto', 'produtor', 'avaliacoes', 'produtosCategoria'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $produto = $this->repository->find($id);
        $categorias = $this->categorias;

        return view('produto.form_produto', compact('categorias','produto'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $produto = $this->repository->find($id);

        tap($produto)->update([
            'nome' => $request->nome,
            'preco' => $request->preco,
            'desconto' => $request->desconto,
            'preco_desconto' => $request->preco - (($request->preco * $request->desconto)/100),

            'descricao' => $request->descricao,
            'estoque' => $request->estoque,
            'categoria_id' => $request->categoria,

            // 'imagem_01' => isset($request->imagens[0]) ? Helper::armazenarArquivo($request->imagens[0], 'files/produtos') : null,
            // 'imagem_02' => isset($request->imagens[1]) ? Helper::armazenarArquivo($request->imagens[1], 'files/produtos') : null,
            // 'imagem_03' => isset($request->imagens[2]) ? Helper::armazenarArquivo($request->imagens[2], 'files/produtos') : null,
            // 'imagem_04' => isset($request->imagens[3]) ? Helper::armazenarArquivo($request->imagens[3], 'files/produtos') : null,
            // 'imagem_05' => isset($request->imagens[4]) ? Helper::armazenarArquivo($request->imagens[4], 'files/produtos') : null,

        ]);


        $checkAtt = 'Produto atualizado com sucesso!';
        return redirect()->route('listagem_produtos')->with('checkAtt', $checkAtt);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $produto = $this->repository->find($id);
        $pivo = $produto->produtor_has_produto[0];

        $pivo->delete();
        $produto->delete();

        $check = 'Produto deletado com sucesso!';
        return redirect()->route('produto.indexAuth')->with('check',$check);
    }
}
