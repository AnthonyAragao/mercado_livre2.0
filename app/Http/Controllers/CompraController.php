<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Exemplar;
use App\Models\Produto;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
class CompraController extends Controller
{
    public function metodoPagamento()
    {
        $produto = Produto::find(Crypt::decrypt(request('id')));
        return view('pedidos.metodo_pagamento', compact('produto'));
    }

    public function index()
    {
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

    public function show(string $id)
    {
        $compra = Compra::find(Crypt::decrypt($id));
        $produto = $compra->exemplar[0]->pivo->produto;

        return view('pedidos.detalhes_compra', compact('compra', 'produto'));
    }

    public function processaCompra($session)
    {
        \Stripe\Stripe::setApiKey(config('stripe.sk'));

        $checkoutSession = \Stripe\Checkout\Session::retrieve($session->id);
        $produto = Produto::find($checkoutSession->metadata->produto);

        $compra = Compra::create([
            'preco_compra' => $checkoutSession->metadata->preco,
            'data' => Carbon::now()->toDateString(),
            'email_comprador' => $checkoutSession->customer_details->email,
            'transaction_id' => $checkoutSession->payment_intent,
            'payment_status' => $checkoutSession->payment_status,
            'payment_method' => $checkoutSession->payment_method_types[0],
            'usuario_id' =>  $checkoutSession->metadata->usuario_id,
        ]);

        Exemplar::create([
            'compra_id' => $compra->id,
            'pivo_id' => $checkoutSession->metadata->pivo_id,
            'preco' => $checkoutSession->metadata->preco,
        ]);

        $this->atualizarEstoque($produto, $checkoutSession->payment_status);
    }

    private function atualizarEstoque($produto, $statusPagamento)
    {
        if($statusPagamento == 'paid'){
            tap($produto)->update([
                'estoque' => $produto->estoque - 1,
                'vendas' => $produto->vendas + 1,
            ]);
        }
    }
}
