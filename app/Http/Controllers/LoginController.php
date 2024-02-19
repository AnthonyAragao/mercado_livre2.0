<?php

namespace App\Http\Controllers;

use App\Models\DadoAcesso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function auth(Request $request)
    {
        // validação
        $request->validate([
            'email' => ['required','email'],
            'password' => ['required'],
        ],[
            'email.required' => 'O campo email é obrigatorio!',
            'email.email' => 'O email não é valido',
            'password.required' => 'O campo senha é obrigatorio!'
        ]);
        // dados do login
        $email = trim($request->email);
        $password = trim($request->password);

        $usuario = DadoAcesso::where('email', $email)->first();

        // Verifica se existe usuario
        if(!$usuario){
            return redirect()->back()->with('erro', 'Usuário ou senha invalido');
        }

        // Verifica se a senha do usuario esta correta
        if(!Hash::check($password, $usuario->password)){
            return redirect()->back()->with('erro', 'Usuário ou senha invalido');
        }

        // Autentica o usuário
        if($usuario && Hash::check($password, $usuario->password)){
            Auth::login($usuario);
            // Redireciona para uma rota
            return redirect()->route('dashboard');
        }
    }

    public function destroy(Request $request)
    {
        Auth::guard('usuario')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

}
