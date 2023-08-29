<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
    <link rel="icon" href="{{asset('images/icon-mercado-libre.png')}}">
    <title>Cadastrar produto</title>
</head>

<body>
    <header>
        <div class="logo">
            <img src="{{ asset('images/mercado-libre.png') }}" alt="">
        </div>
    </header>

    <main>
        <div class="container-card">
            <form method="POST" action="{{ route('produto.store') }}" enctype="multipart/form-data" >
                @csrf
                <div class="input-box">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" required>
                </div>

                <div class="input-box">
                    <label for="preco">Preço:</label>
                    <input type="number" id="preco" name="preco" required>
                </div>

                <div class="input-box">
                    <label for="descricao">Descrição do Produto:</label>
                    <input type="text" id="descricao" name="descricao" required>
                </div>

                <div class="input-box">
                    <label for="estoque">Estoque:</label>
                    <input type="number" id="estoque" name="estoque" required>
                </div>

                <div class="input-box">
                    <label for="desconto">Desconto:</label>
                    <input type="number" id="desconto" name="desconto">
                </div>

                <select class="form-select" aria-label="Categoria" aria-describedby="basic-addon1" name="categoria" id="categoria" style="width: 100%">
                    <option value="" disabled selected>Selecione uma Categoria</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}">
                            {{ $categoria->nome }}
                        </option>
                    @endforeach
                </select>

                <div class="">
                    <label for="foto_01">Foto 01:</label>
                    <input type="file" id="foto_01" name="foto_01[]" multiple="multiple" required>
                </div>

                <button type="submit">Cadastrar Produto</button>
            </form>
        </div>

    </main>
</body>
</html>
