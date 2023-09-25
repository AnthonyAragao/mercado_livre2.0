@extends('templates.template_view')

@section('insert_head')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
    <title>Complete os dados para criar sua conta</title>
@endsection

@section('insert_body')
    <header>
        <div class="logo">
            <img src="{{ asset('images/mercado-libre.png') }}" alt="">
        </div>
    </header>

    <main>
        <div class="container-card">
            <form method="POST" action="{{ route('produtor.store') }}">
                @csrf
                <h2>Dados do Produtor</h2>

                <div class="input-box">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" required>
                </div>

                <div class="input-box">
                    <label for="email">Email:</label>
                    <input type="text" id="email" name="email" required>
                </div>

                <div class="input-group">
                    <div class="input-box">
                        <label for="cpf">CPF:</label>
                        <input type="text" id="cpf" name="cpf" required>
                    </div>

                    <div class="input-box">
                        <label for="password">Senha:</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                </div>

                <div class="input-group">
                    <div class="input-box">
                        <label for="nascimento">Nascimento:</label>
                        <input type="date" id="nascimento" name="nascimento" required>
                    </div>

                    <div class="input-box">
                        <label for="telefone">Telefone:</label>
                        <input type="text" id="telefone" name="telefone" required>
                    </div>
                </div>

                <div class="input-group">
                    <div class="input-box">
                        <label for="logradouro">Logradouro:</label>
                        <input type="text" id="logradouro" name="logradouro" required>
                    </div>

                    <div class="input-box">
                        <label for="cep">CEP:</label>
                        <input type="text" id="cep" name="cep" required>
                    </div>
                </div>

                <div class="input-group">
                    <div class="input-box">
                        <label for="bairro">Bairro:</label>
                        <input type="text" id="bairro" name="bairro" required>
                    </div>

                    <div class="input-box">
                        <label for="numero">Número:</label>
                        <input type="text" id="numero" name="numero" required>
                    </div>
                </div>

                <div class="input-box">
                    <label for="complemento">Complemento:</label>
                    <input type="text" id="complemento" name="complemento" required>
                </div>

                <div class="input-group">
                    <select class="form-select" aria-label="Cidade" aria-describedby="basic-addon1" name="cidade" id="cidade">
                        <option value="" disabled selected>Selecione um Estado</option>
                        @foreach ($cidades as $cidade)
                            <option value="{{ $cidade->id }}">
                                {{ $cidade->nome }}
                            </option>
                        @endforeach
                    </select>

                    <select class="form-select" aria-label="Municipio" aria-describedby="basic-addon1" name="municipio"
                        id="municipio">
                        <option value="" disabled selected>Selecione um Municipio</option>
                        @foreach ($municipios as $municipio)
                            <option value="{{ $municipio->id }}">
                                {{ $municipio->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <h2>Dados da Empresa</h2>

                <div class="input-box">
                    <label for="nome_empresa">Nome da empresa:</label>
                    <input type="text" id="nome_empresa" name="nome_empresa" required>
                </div>

                <div class="input-box">
                    <label for="razao_empresa">Razão da Empresa:</label>
                    <input type="text" id="razao_empresa" name="razao_empresa" required>
                </div>


                <div class="input-box">
                    <label for="email_empresa">Email da Empresa:</label>
                    <input type="email" id="email_empresa" name="email_empresa" required>
                </div>

                <div class="input-group">
                    <div class="input-box">
                        <label for="cnpj">CNPJ:</label>
                        <input type="text" id="cnpj" name="cnpj" required>
                    </div>

                    <div class="input-box">
                        <label for="telefone_empresa">Telefone da Empresa:</label>
                        <input type="text" id="telefone_empresa" name="telefone_empresa" required>
                    </div>
                </div>

                <a href="{{ route('login') }}" class="call-login">
                    Already registered?
                </a>

                <button type="submit">Registrar</button>
                </div>
            </form>
        </div>
    </main>
@endsection
