<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Exemplar;
use App\Models\Produto;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class CompraController extends Controller
{
    // protected $compras, $exemplar;

    // public function __construct(Compra $compras, Exemplar $exemplar) {
    //     $this->compras = $compras;
    //     $this->exemplar = $exemplar;
    // }

    public function congratulations(){
        return view('pedidos.compra_realizada');
    }

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

    public function atualizarCompra($session)
    {
        \Stripe\Stripe::setApiKey(config('stripe.sk'));

        $checkoutSession = \Stripe\Checkout\Session::retrieve($session->id);
        $compra = Compra::where('transaction_id', $checkoutSession->payment_intent)->first();

        $compra->update([
            'payment_status' => $checkoutSession->payment_status,
        ]);

        $produto = Produto::find($checkoutSession->metadata->produto);

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


    public function show(string $id)
    {
        $compra = Compra::find(Crypt::decrypt($id));
        return view('pedidos.detalhes_compra', compact('compra'));
    }

}
