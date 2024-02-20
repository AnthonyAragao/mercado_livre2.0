<?php

namespace App\Http\Controllers;

use App\Models\Avaliacao;
use App\Models\Compra;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Gate;

class AvaliacaoController extends Controller
{
    private $avaliacoes;
    public function __construct(Avaliacao $avaliacoes)
    {
        $this->avaliacoes = $avaliacoes;
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
        $this->avaliacoes->create([
            'comentario' => $request->opiniao,
            'status_id' => $request->avaliacao,
            'compra_id' => Crypt::decrypt($request->compra),
            'produto_id' => Crypt::decrypt($request->produto),
            'usuario_id' => Auth::user()->usuario->first()->id,
            'data' => Carbon::now()->toDateString()
        ]);

        $check = [
            'title' => 'Avaliação feita',
            'mensagem' => 'Agradeçemos pelo seu Feedback'
        ];
        return redirect()->route('pedido.index')->with('check', $check);
    }
}
