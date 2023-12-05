<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Produto;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class StripeController extends Controller{
    protected $compras;
    public function __construct(Compra $compras) {
        $this->compras = $compras;
    }

    public function session($id){
        $produto = Produto::find(Crypt::decrypt($id));
        \Stripe\Stripe::setApiKey(config('stripe.sk'));

        // dd($stripe->paymentIntents)

        try {
           // Criar um produto no Stripe (associado ao produto no seu sistema)
            $product = \Stripe\Product::create([
                'name' => $produto->nome,
                'description' => $produto->descricao,
            ]);

            // Criar um preço associado ao produto
            $price = \Stripe\Price::create([
                'product' => $product->id,
                'unit_amount' => ($produto->preco_desconto) * 100,
                'currency' => 'BRL',
            ]);

            // Criar uma sessão de checkout e vincular ao preço criado
            $session = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [
                    [
                        'price' => $price->id,
                        'quantity' => 1,
                    ],
                ],
                'mode' => 'payment',

                'success_url' => route('produto.index'),
            ]);


            $this->salvarDadosNoBanco($produto, $session);
            return redirect()->away($session->url);

        }catch (\Stripe\Exception\ApiErrorException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }



    }



    public function salvarDadosNoBanco($produto, $session){
        dd($produto->preco_desconto);

        $dataAtual = Carbon::now()->toDateString();
        $this->compras->create([
            'session_id_stripe' => $session->id,
            'data' => $dataAtual,
            // 'preco_compra' =>
            // 'usuario_id' =>
        ]);


    }






}
