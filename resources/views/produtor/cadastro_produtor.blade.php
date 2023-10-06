@extends('templates.template_view')

@section('insert_head')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
    <title>Complete os dados para criar sua conta</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-mask-plugin@1.14.16/dist/jquery.mask.min.js"></script>
@endsection

@section('insert_body')
    <header>
        <a href="{{route('listagem_produtos')}}" class="logo">
            <img src="{{ asset('images/mercado-libre.png') }}" alt="">
        </a>
    </header>

    <main>
        <div class="container-card">
            <form method="POST" action="{{ route('produtor.store') }}">
                @csrf
                <h2>Dados do Produtor</h2>

                <div class="input-box">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" required placeholder="Insira seu nome">
                </div>

                <div class="input-box">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required placeholder="Insira seu email">
                </div>

                <div class="input-group">
                    <div class="input-box">
                        <label for="cpf">CPF:</label>
                        <input type="text" id="cpf" name="cpf" required length="14" placeholder="Insira seu CPF">
                    </div>

                    <div class="input-box">
                        <label for="password">Senha:</label>
                        <input type="password" id="password" name="password" required placeholder="Insira sua senha">
                    </div>
                </div>

                <div class="input-group">
                    <div class="input-box">
                        <label for="nascimento">Nascimento:</label>
                        <input type="date" id="nascimento" name="nascimento" required>
                    </div>

                    <div class="input-box">
                        <label for="telefone">Telefone:</label>
                        <input type="text" id="telefone" name="telefone" required placeholder="Insira seu telefone">
                    </div>
                </div>

                <div class="input-group">
                    <div class="input-box">
                        <label for="cep">CEP:</label>
                        <input type="text" id="cep" name="cep" required placeholder="Insira seu CEP">
                    </div>

                    <div class="input-box">
                        <label for="logradouro">Logradouro:</label>
                        <input type="text" id="logradouro" name="logradouro" required placeholder="Insira o logradouro">
                    </div>
                </div>

                <div class="input-group">
                    <div class="input-box">
                        <label for="bairro">Bairro:</label>
                        <input type="text" id="bairro" name="bairro" required placeholder="Insira seu bairro">
                    </div>

                    <div class="input-box">
                        <label for="numero">Número:</label>
                        <input type="text" id="numero" name="numero" required placeholder="Insira seu número">
                    </div>
                </div>

                <div class="input-box">
                    <label for="complemento">Complemento:</label>
                    <input type="text" id="complemento" name="complemento" required placeholder="Insira o complemento">
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
                    <input type="text" id="nome_empresa" name="nome_empresa" required placeholder="Insira o nome de empresa">
                </div>

                <div class="input-box">
                    <label for="razao_empresa">Razão da Empresa:</label>
                    <input type="text" id="razao_empresa" name="razao_empresa" required placeholder="Insira a razão da empresa">
                </div>


                <div class="input-box">
                    <label for="email_empresa">Email da Empresa:</label>
                    <input type="email" id="email_empresa" name="email_empresa" required placeholder="Insira o email da empresa">
                </div>

                <div class="input-group">
                    <div class="input-box">
                        <label for="cnpj">CNPJ:</label>
                        <input type="text" id="cnpj" name="cnpj" required placeholder="Insira o CNPJ da empresa">
                    </div>

                    <div class="input-box">
                        <label for="telefone_empresa">Telefone da Empresa:</label>
                        <input type="text" id="telefone_empresa" name="telefone_empresa" required placeholder="Insira o telefone da empresa">
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

@section('insert_script')
    <script>
        $(document).ready(function() {
            $('#cpf').mask('000.000.000-00');
            $('#telefone').mask('(00) 00000-0000');
            $('#telefone_empresa').mask('(00) 00000-0000');
            $('#cnpj').mask('00.000.000/0000-00');
            $('#cep').mask('00000-000');
        });
    </script>

@endsection
