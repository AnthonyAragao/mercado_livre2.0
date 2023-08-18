<?php

namespace App\Http\Controllers;

use App\Models\Cidade;
use App\Models\DadoAcesso;
use App\Models\DadoEmpresa;
use App\Models\Endereco;
use App\Models\Municipio;
use App\Models\Produtor;
use Illuminate\Http\Request;

class ProdutoController extends Controller{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    private $dados_acesso, $produtores, $enderecos, $dados_empresa;
    public function __construct(DadoAcesso $dados_acesso, DadoEmpresa $dados_empresa, Produtor $produtores, Endereco $enderecos){
        $this->dados_acesso = $dados_acesso;
        $this->dados_empresa = $dados_empresa;
        $this->produtores = $produtores;
        $this->enderecos = $enderecos;

        $this->cidades = Cidade::all();
        $this->municipios = Municipio::all();
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
    public function create()
    {
        $cidades = $this->cidades;
        $municipios = $this->municipios;
        return view('produtor.cadastro_produtor', compact('cidades', 'municipios'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        try{
            $produtor = $this->produtores->create([
                'dados_acesso_id' => $this->dados_acesso->create([
                    'nome' => $request->nome,
                    'email' => $request->email,
                    'cpf' => $request->cpf,
                    'password' => bcrypt($request->password),
                    'nascimento' => $request->nascimento,
                    'telefone' => $request->telefone,
                    'endereco_id' => $this->enderecos->create([
                        'logradouro' => $request->logradouro,
                        'cep' => $request->cep,
                        'bairro' => $request->bairro,
                        'numero' => $request->numero,
                        'complemento' => $request->complemento,
                        'municipio_id' => $request->municipio,
                    ])->id,
                ])->id,

                'dados_empresa_id' => $this->dados_empresa->create([
                    'nome' => $request->nome_empresa,
                    'razao_empresa' => $request->razao_empresa,
                    'email' => $request->email_empresa,
                    'cnpj' => $request->cnpj,
                    'telefone' => $request->telefone_empresa,
                ])->id,

            ]);

            return redirect()->route('login');
        }catch(Exception $e){

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id){
        $produtor = $this->produtores->find($id);
        $municipios = $this->municipios;
        $cidades = $this->cidades;
        $enderecos = $this->enderecos;
        $form = 'disabled';
        return view('produtor.form_produtor', compact(
            'produtor',
            'municipios',
            'cidades',
            'enderecos',
            'form'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id){
        $produtor = $this->produtores->find($id);
        $municipios = $this->municipios;
        $cidades = $this->cidades;
        $enderecos = $this->enderecos;
        return view('produtor.form_produtor', compact(
            'produtor',
            'municipios',
            'cidades',
            'enderecos',
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id){
        $produtor = $this->produtores->find($id);
        tap($this->produtores->find($produtor->id))->update([
            'dados_acesso_id' => tap($this->dados_acesso->find($produtor->dados_acesso_id))->update([
                'nome' => $request->nome,
                'email' => $request->email,
                'cpf' => $request->cpf,
                'password' => isset($request->password) ? bcrypt($request->password) : $produtor->dado_acesso->password,
                'nascimento' => $request->nascimento,
                'telefone' => $request->telefone,
                'endereco_id' => tap($this->enderecos->find($produtor->dado_acesso->endereco_id))->update([
                    'logradouro' => $request->logradouro,
                    'cep' => $request->cep,
                    'bairro' => $request->bairro,
                    'numero' => $request->numero,
                    'complemento' => $request->complemento,
                    'municipio_id' => isset($request->municipio) ? $request->municipio : $produtor->dado_acesso->endereco->municipio_id,
                ])->id,
            ])->id,

            'dados_empresa_id' => tap($this->dados_empresa->find($produtor->dados_empresa_id))->update([
                'nome' => $request->nome_empresa,
                'razao_empresa' => $request->razao_empresa,
                'email' => $request->email_empresa,
                'cnpj' => $request->cnpj,
                'telefone' => $request->telefone_empresa,
            ])->id,
        ]);

        return redirect()->route('produtor.show', $produtor->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
