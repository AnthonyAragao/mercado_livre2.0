<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
                    <input type="number" step="any" id="preco" name="preco" min="0" required>
                </div>

                <div class="input-box">
                    <label for="descricao">Descrição do Produto:</label>
                    <input type="text" id="descricao" name="descricao" required>
                </div>

                <div class="input-box">
                    <label for="estoque">Estoque:</label>
                    <input type="number" id="estoque" name="estoque" min="0" required>
                </div>

                <div class="input-box">
                    <label for="desconto">Desconto:</label>
                    <input type="number" id="desconto" name="desconto" min="0">
                </div>

                <div class="input-box">
                    <label for="categoria">Categoria:</label>
                    <select class="form-select" aria-label="Categoria" aria-describedby="basic-addon1" name="categoria" id="categoria" style="width: 100%">
                        <option value="" disabled selected>Selecione uma Categoria</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}">
                                {{ $categoria->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="input-box">
                    <label for="imagens">Insira as imagens:(Insira no máximo 5 imagens)</label>
                    <input type="file" class="form-control" id="imagens" name="imagens[]" multiple="multiple" required>
                </div>

                <button type="submit">Cadastrar Produto</button>
            </form>
        </div>

    </main>
</body>
</html>
