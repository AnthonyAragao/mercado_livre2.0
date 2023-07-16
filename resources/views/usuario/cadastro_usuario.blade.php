<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
    <link rel="icon" href="{{asset('images/icon-mercado-libre.png')}}">
    <title>Complete os dados para criar sua conta</title>
</head>

<body>
    <header>
        <div class="logo">
            <img src="{{ asset('images/mercado-libre.png') }}" alt="">
        </div>
    </header>

    <main>
        <div class="container-card">
            <form method="POST" action="{{ route('usuarios.store') }}">
                @csrf
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

                <a href="{{ route('login') }}" class="call-login">
                    Already registered?
                </a>

                <button type="submit">Registrar</button>
                </div>
            </form>
        </div>

    </main>


</body>
</html>
