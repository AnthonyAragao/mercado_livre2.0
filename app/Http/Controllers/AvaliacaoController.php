<?php

namespace App\Http\Controllers;

use App\Models\Avaliacao;
use App\Models\Compra;
use App\Models\StatusAvaliacao;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Gate;

class AvaliacaoController extends Controller
{

    private $avaliacoes;
    public function __construct(Avaliacao $avaliacoes){
        $this->avaliacoes = $avaliacoes;
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
    public function create(string $id)
    {
        $compra = Compra::find(Crypt::decrypt($id));
        
        if(Gate::denies('opinarProduct', $compra)){
            abort(403);
        };

        return view('avaliacao.reviews', compact('compra'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dataAtual = Carbon::now()->toDateString();
        $this->avaliacoes->create([
            'comentario' => $request->opiniao,
            'status_id' => $request->avaliacao,
            'compra_id' => Crypt::decrypt($request->compra),
            'produto_id' => Crypt::decrypt($request->produto),
            'usuario_id' => Auth::user()->usuario->first()->id,
            'data' => $dataAtual
        ]);
        $check = 'Agradeçemos pelo seu Feedback';

        return redirect()->route('pedido.index')->with('check',$check);
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
