<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class StripeController extends Controller{

    public function session($id){
        $produto = Produto::find(Crypt::decrypt($id));
        \Stripe\Stripe::setApiKey(config('stripe.sk'));

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


            return redirect()->away($session->url);

        } catch (\Stripe\Exception\ApiErrorException $e) {
            $api_error = $e->getMessage();
            return response()->json(['error' => $e->getMessage()], 500);
        }


        if(empty($api_error) && $session){
            $response = array(
                'status' => 1,
                'message' => 'Checkout Session created successfully!',
                'sessionId' => $session->id
            );
            json_encode($response);
        }else{
            $response = array(
                'status' => 0,
                'error' => array(
                    'message' => 'Checkout Session creation failed!'
                )
            );
        }








    }
}
