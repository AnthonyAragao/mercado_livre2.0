<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <form method="POST" action="{{ route('usuarios.store') }}">
        @csrf

        <div id="dados_acesso">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome"> <br>

            <label for="email">Email:</label>
            <input type="text" id="email" name="email"> <br>

            <label for="nascimento">Nascimento:</label>
            <input type="date" id="nascimento" name="nascimento"> <br>

            <label for="telefone">Telefone:</label>
            <input type="text" id="telefone" name="telefone"> <br>

            <label for="cpf">CPF:</label>
            <input type="text" id="cpf" name="cpf"> <br>

            <label for="password">Senha:</label>
            <input type="password" id="password" name="password"> <br>
        </div>


        <div id="endereco">
            <label for="logradouro">logradouro:</label>
            <input type="text" id="logradouro" name="logradouro"> <br>

            <label for="cep">cep:</label>
            <input type="text" id="cep" name="cep"> <br>

            <label for="bairro">bairro:</label>
            <input type="text" id="bairro" name="bairro"> <br>

            <label for="numero">numero:</label>
            <input type="text" id="numero" name="numero"> <br>

            <label for="complemento">complemento:</label>
            <input type="text" id="complemento" name="complemento"> <br>

        </div>



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


        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>

        <button type="submit">salvar</button>
    </form>
</body>
</html>
