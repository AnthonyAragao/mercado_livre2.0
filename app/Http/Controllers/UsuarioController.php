<?php

namespace App\Http\Controllers;

use App\Models\Cidade;
use App\Models\DadoAcesso;
use App\Models\Endereco;
use App\Models\Municipio;
use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller {
     /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    private $dados_acesso, $usuarios, $enderecos;
    public function __construct(DadoAcesso $dados_acesso, Usuario $usuarios, Endereco $enderecos ){
        $this->dados_acesso = $dados_acesso;
        $this->usuarios = $usuarios;
        $this->enderecos = $enderecos;

        $this->cidades = Cidade::all();
        $this->municipios = Municipio::all();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(){
        $usuarios = $this->usuarios::all();
        return view('welcome', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        $cidades = $this->cidades;
        $municipios = $this->municipios;
        return view('usuario.cadastro_usuario', compact('cidades', 'municipios'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        try{
            $usuario = $this->usuarios->create([
                'nascimento' => $request->nascimento,
                'telefone' => $request->telefone,

                'dados_acesso_id' => $this->dados_acesso->create([
                    'nome' => $request->nome,
                    'email' => $request->email,
                    'cpf' => $request->cpf,
                    'password' => bcrypt($request->password),

                    'endereco_id' => $this->enderecos->create([
                        'logradouro' => $request->logradouro,
                        'cep' => $request->cep,
                        'bairro' => $request->bairro,
                        'numero' => $request->numero,
                        'complemento' => $request->complemento,
                        'municipio_id' => $request->municipio,
                    ])->id,
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
        $usuario = $this->usuarios->find($id);
        $municipios = $this->municipios;
        $cidades = $this->cidades;
        $enderecos = $this->enderecos;
        $form = 'disabled';
        return view('usuario.form_usuario', compact(
            'usuario',
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
        $usuario = $this->usuarios->find($id);
        $municipios = $this->municipios;
        $cidades = $this->cidades;
        $enderecos = $this->enderecos;
        return view('usuario.form_usuario', compact(
            'usuario',
            'municipios',
            'cidades',
            'enderecos',
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id){
        $usuario = $this->usuarios->find($id);
        tap($this->usuarios->find($usuario->id))->update([
            'nascimento' => $request->nascimento,
            'telefone' => $request->telefone,

            'dados_acesso_id' => tap($this->dados_acesso->find($usuario->dados_acesso_id))->update([
                'nome' => $request->nome,
                'email' => $request->email,
                'cpf' => $request->cpf,
                'password' => isset($request->password) ? bcrypt($request->password) : $usuario->dado_acesso->password,

                'endereco_id' => tap($this->enderecos->find($usuario->dado_acesso->endereco_id))->update([
                    'logradouro' => $request->logradouro,
                    'cep' => $request->cep,
                    'bairro' => $request->bairro,
                    'numero' => $request->numero,
                    'complemento' => $request->complemento,
                    'municipio_id' => isset($request->municipio) ? $request->municipio : $usuario->dado_acesso->endereco->municipio_id,
                ])->id,
            ])->id,
        ]);


        return redirect()->route('usuarios.show', $usuario->id);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
