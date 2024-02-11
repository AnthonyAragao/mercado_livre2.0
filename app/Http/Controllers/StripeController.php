<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Support\Facades\Crypt;

class StripeController extends Controller{
    public function session($id, $payment_method){
        \Stripe\Stripe::setApiKey(config('stripe.sk'));

        $produto = Produto::find(Crypt::decrypt($id));
        $pivo = $produto->produtor_has_produto->first();

        if ($produto->estoque < 1) {
            return response()->json(['error' => 'Produto indisponível'], 404);
        }

        try {
            // Criar um produto no Stripe (associado ao produto no seu sistema)
            $product = \Stripe\Product::create([
                'name' => $produto->nome,
                'description' => $produto->descricao,
            ]);

            $price = \Stripe\Price::create([
                'product' => $product->id,
                'unit_amount' => ($produto->preco_desconto) * 100,
                'currency' => 'BRL',
            ]);

            $session = \Stripe\Checkout\Session::create([
                'payment_method_types' => [$payment_method], 
                'line_items' => [
                    [
                        'price' => $price->id,
                        'quantity' => 1,
                    ],
                ],
                'metadata' => [
                    'produto' => $produto->id,
                    'preco' => $produto->preco_desconto,
                    'pivo_id' => $pivo->id,
                    'usuario_id' => auth()->user()->usuario[0]->id,
                ],
                'mode' => 'payment',
                'success_url' => route('congratulations'),
                // 'cancel_url'  => route('checkout'),
            ]);

            return redirect()->away($session->url);
        }catch (\Stripe\Exception\ApiErrorException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}
