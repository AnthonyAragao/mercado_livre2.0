<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
    <link rel="icon" href="{{asset('images/icon-mercado-libre.png')}}">
    <title>Mercado Libre</title>
</head>

<body>
    <header>
        <div class="logo">
            <img src="{{ asset('images/mercado-libre.png') }}" alt="">
        </div>
    </header>

    <main>
        <div class="container-card">
        <form method="POST" enctype="multipart/form-data"
        action="{{ route('produtor.update', $produtor->id) }}">
        @method('PUT')
            @csrf
                <h2>Dados do Produtor</h2>
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" value="{{$produtor->dadoAcesso->nome ?? old('nome')}}"
                {{ isset($form) ? $form : null }}>

                <label for="email">Email:</label>
                <input type="text" id="email" name="email" value="{{$produtor->dadoAcesso->email ?? old('email')}}"
                {{ isset($form) ? $form : null }}>

                <div class="input-group">
                    <div class="input-box">
                        <label for="cpf">CPF:</label>
                        <input type="text" id="cpf" name="cpf" value="{{$produtor->dadoAcesso->cpf ?? old('cpf')}}"
                        {{ isset($form) ? $form : null }}>
                    </div>

                    <div class="input-box">
                        <label for="telefone">Telefone:</label>
                        <input type="text" id="telefone" name="telefone" value="{{$produtor->dadoAcesso->telefone ?? old('telefone')}}"
                        {{ isset($form) ? $form : null }}>
                    </div>
                </div>

                {{-- <label for="password">Senha:</label>
                <input type="password" id="password" name="password">  --}}

                <div class="input-group">
                    <div class="input-box">
                        <label for="nascimento">Nascimento:</label>
                        <input type="date" id="nascimento" name="nascimento" value="{{$produtor->dadoAcesso->nascimento ?? old('nascimento')}}"
                        {{ isset($form) ? $form : null }} data-format="dd/mm/yyyy">
                    </div>

                    <div class="input-box">
                        <label for="logradouro">logradouro:</label>
                        <input type="text" id="logradouro" name="logradouro" {{ isset($form) ? $form : null }}
                        value="{{$produtor->dadoAcesso->endereco->logradouro ?? old('logradouro')}}">
                    </div>
                </div>


                <div class="input-group">
                    <div class="input-box">
                        <label for="cep">CEP:</label>
                        <input type="text" id="cep" name="cep" {{ isset($form) ? $form : null }}
                        value="{{$produtor->dadoAcesso->endereco->cep ?? old('cep')}}">
                    </div>

                    <div class="input-box">
                        <label for="bairro">Bairro:</label>
                        <input type="text" id="bairro" name="bairro" {{ isset($form) ? $form : null }}
                        value="{{$produtor->dadoAcesso->endereco->bairro ?? old('bairro')}}">
                    </div>
                </div>

                <div class="input-group">
                    <div class="input-box">
                        <label for="numero">Número:</label>
                        <input type="text" id="numero" name="numero" {{ isset($form) ? $form : null }}
                        value="{{$produtor->dadoAcesso->endereco->numero ?? old('numero')}}">
                    </div>

                    <div class="input-box">
                        <label for="complemento">complemento:</label>
                        <input type="text" id="complemento" name="complemento" {{ isset($form) ? $form : null }}
                        value="{{$produtor->dadoAcesso->endereco->complemento ?? old('complemento')}}">
                    </div>
                </div>

                <div class="input-group">
                    <select class="form-select" aria-label="Cidade" aria-describedby="basic-addon1" name="cidade" id="cidade"
                    {{ isset($form) ? $form : null }}>
                        <option value="{{isset($produtor) ? $produtor->dadoAcesso->endereco->municipio->cidade->id : '' }}" disabled selected>
                            {{isset($produtor) ? $produtor->dadoAcesso->endereco->municipio->cidade->nome : 'Selecione um Estado'}}
                        </option>
                        @foreach ($cidades as $cidade)
                            <option value="{{ $cidade->id }}">
                                {{ $cidade->nome }}
                            </option>
                        @endforeach
                    </select>

                    <select class="form-select" aria-label="Municipio" aria-describedby="basic-addon1" name="municipio"
                        id="municipio"   {{ isset($form) ? $form : null }}>
                        <option value="{{isset($produtor) ? $produtor->dadoAcesso->endereco->municipio->id:''}}" disabled selected>
                            {{isset($produtor) ? $produtor->dadoAcesso->endereco->municipio->nome:'Selecione um Municipio'}}
                        </option>
                        @foreach ($municipios as $municipio)
                            <option value="{{ $municipio->id }}">
                                {{ $municipio->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <h2>Dados da Empresa</h2>

                <label for="nome_empresa">Nome da empresa:</label>
                <input type="text" id="nome_empresa" name="nome_empresa" required {{ isset($form) ? $form : null }}
                value="{{$produtor->dadosEmpresa->nome ?? old('nome_empresa')}}">

                <label for="razao_empresa">Razão da Empresa:</label>
                <input type="text" id="razao_empresa" name="razao_empresa" {{ isset($form) ? $form : null }}
                value="{{$produtor->dadosEmpresa->razao_empresa ?? old('razao_empresa')}}">

                <label for="email_empresa">Email da Empresa:</label>
                <input type="email" id="email_empresa" name="email_empresa" {{ isset($form) ? $form : null }}
                value="{{$produtor->dadosEmpresa->email ?? old('email_empresa')}}">


                <div class="input-group">
                    <div class="input-box">
                        <label for="cnpj">CNPJ:</label>
                        <input type="text" id="cnpj" name="cnpj" required {{ isset($form) ? $form : null }}
                        value="{{$produtor->dadosEmpresa->cnpj ?? old('cnpj')}}">
                    </div>

                    <div class="input-box">
                        <label for="telefone_empresa">Telefone da Empresa:</label>
                        <input type="text" id="telefone_empresa" name="telefone_empresa" required {{ isset($form) ? $form : null }}
                        value="{{$produtor->dadosEmpresa->telefone ?? old('telefone_empresa')}}">
                    </div>
                </div>


                @if (Route::currentRouteName() == 'produtor.show')
                    <a href="{{route('produtor.edit', $produtor->id)}}">
                        <button type="button">Modificar</button>
                    </a>
                @else
                    <button type="submit">Salvar</button>
                @endif
        </form>
    </div>
</main>

</body>
</html>
