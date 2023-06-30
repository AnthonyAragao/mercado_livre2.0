<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    @if (isset($usuario))
        <form method="POST" enctype="multipart/form-data"
        action="{{ route('usuarios.update', $usuario->id) }}">
        @method('PUT')
    @else
        <form method="POST" action="{{ route('usuarios.store') }}">
    @endif
        @csrf

        <div id="dados_acesso">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="{{$usuario->dadoAcesso->nome ?? old('nome')}}"
            {{ isset($form) ? $form : null }}> <br>


            <label for="email">Email:</label>
            <input type="text" id="email" name="email" value="{{$usuario->dadoAcesso->email ?? old('email')}}"
            {{ isset($form) ? $form : null }}> <br>



            <label for="nascimento">Nascimento:</label>
            <input type="date" id="nascimento" name="nascimento" value="{{$usuario->nascimento ?? old('nascimento')}}"
            {{ isset($form) ? $form : null }} data-format="dd/mm/yyyy"> <br>



            <label for="telefone">Telefone:</label>
            <input type="text" id="telefone" name="telefone" value="{{$usuario->telefone ?? old('telefone')}}"
            {{ isset($form) ? $form : null }}> <br>


            <label for="cpf">CPF:</label>
            <input type="text" id="cpf" name="cpf" value="{{$usuario->dadoAcesso->cpf ?? old('cpf')}}"
            {{ isset($form) ? $form : null }}> <br>


            {{-- <label for="password">Senha:</label>
            <input type="password" id="password" name="password"> <br> --}}
        </div>


        <div id="endereco">
            <label for="logradouro">logradouro:</label>
            <input type="text" id="logradouro" name="logradouro" {{ isset($form) ? $form : null }}
            value="{{$usuario->dadoAcesso->endereco->logradouro ?? old('logradouro')}}"> <br>


            <label for="cep">cep:</label>
            <input type="text" id="cep" name="cep" {{ isset($form) ? $form : null }}
            value="{{$usuario->dadoAcesso->endereco->cep ?? old('cep')}}"> <br>


            <label for="bairro">bairro:</label>
            <input type="text" id="bairro" name="bairro" {{ isset($form) ? $form : null }}
            value="{{$usuario->dadoAcesso->endereco->bairro ?? old('bairro')}}"> <br>

            <label for="numero">numero:</label>
            <input type="text" id="numero" name="numero" {{ isset($form) ? $form : null }}
            value="{{$usuario->dadoAcesso->endereco->numero ?? old('numero')}}"> <br>

            <label for="complemento">complemento:</label>
            <input type="text" id="complemento" name="complemento" {{ isset($form) ? $form : null }}
            value="{{$usuario->dadoAcesso->endereco->complemento ?? old('complemento')}}"> <br>



            <select class="form-select" aria-label="Cidade" aria-describedby="basic-addon1" name="cidade" id="cidade"
             {{ isset($form) ? $form : null }}>
                <option value="{{isset($usuario) ? $usuario->dadoAcesso->endereco->municipio->cidade->id : '' }}" disabled selected>
                    {{isset($usuario) ? $usuario->dadoAcesso->endereco->municipio->cidade->nome : 'Selecione um Estado'}}
                </option>
                @foreach ($cidades as $cidade)
                    <option value="{{ $cidade->id }}">
                        {{ $cidade->nome }}
                    </option>
                @endforeach
            </select>

            <select class="form-select" aria-label="Municipio" aria-describedby="basic-addon1" name="municipio"
                id="municipio"   {{ isset($form) ? $form : null }}>
                <option value="{{isset($usuario) ? $usuario->dadoAcesso->endereco->municipio->id:''}}" disabled selected>
                    {{isset($usuario) ? $usuario->dadoAcesso->endereco->municipio->nome:'Selecione um Municipio'}}
                </option>
                @foreach ($municipios as $municipio)
                    <option value="{{ $municipio->id }}">
                        {{ $municipio->nome }}
                    </option>
                @endforeach
            </select>
        </div>


        <div class="flex items-center justify-end mt-4" >
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>

        @if (Route::currentRouteName() == 'usuario.show')
            <button type="submit">salvar</button>
        @endif
    </form>
</body>
</html>
