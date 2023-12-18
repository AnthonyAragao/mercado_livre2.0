<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class StripeController extends Controller{
    public function session($id){
        \Stripe\Stripe::setApiKey(config('stripe.sk'));

        $produto = Produto::find(Crypt::decrypt($id));
        $pivo = $produto->produtor_has_produto->first();
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

            session(['product_details' =>[
                'preco' => $produto->preco_desconto,
                'pivo_id' => $pivo->id
            ]]);


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

                'success_url' => route('success'),
                // 'cancel_url'  => route('checkout'),
            ]);

            return redirect()->away($session->url);
        }catch (\Stripe\Exception\ApiErrorException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
