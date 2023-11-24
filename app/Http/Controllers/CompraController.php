<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $usuario = Auth::user()->usuario[0];

        $compras = Compra::where('usuario_id', $usuario->id)
            ->with([
                'exemplarRelationShip.pivoRelationShip.produtorRelationship.dadoEmpresaRelationship',
                'exemplarRelationShip.pivoRelationShip.produtoRelationship',
                'avaliacaoRelationShip'
                ])
            ->get();

        return view('pedidos.meus_pedidos', compact('compras'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
