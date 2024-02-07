<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Exemplar;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class CompraController extends Controller
{
    protected $compras, $exemplar;

    public function __construct(Compra $compras, Exemplar $exemplar) {
        $this->compras = $compras;
        $this->exemplar = $exemplar;
    }


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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        \Stripe\Stripe::setApiKey(config('stripe.sk'));

        $productDetails = session('product_details');
        $produto = $productDetails['produto'];

        $checkoutSession = \Stripe\Checkout\Session::retrieve($productDetails['session_id']);

        DB::beginTransaction();
        try{
            $compra = $this->compras->create([
                'preco_compra' => $productDetails['preco'],
                'data' => Carbon::now()->toDateString(),
                'email_comprador' => $checkoutSession->customer_details->email,
                'transaction_id' => $checkoutSession->payment_intent,
                'payment_status' => $checkoutSession->payment_status,
                'payment_method' => $checkoutSession->payment_method_types[0],
                'usuario_id' => Auth::user()->usuario[0]->id,
            ]);

            $this->exemplar->create([
                'compra_id' => $compra->id,
                'pivo_id' => $productDetails['pivo_id'],
                'preco' => $productDetails['preco'],
            ]);

            tap($produto)->update([
                'estoque' => $produto->estoque - 1,
                'vendas' => $produto->vendas + 1,
            ]);

            DB::commit();
            session()->forget('product_details');

            return redirect()->route('congratulations');
        }catch(Exception $e){
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $compra = $this->compras->find(Crypt::decrypt($id));

        return view('pedidos.detalhes_compra', compact('compra'));
    }

}
