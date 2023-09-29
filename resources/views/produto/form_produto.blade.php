@extends('templates.template_view')

@section('insert_head')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
    <title>Cadastrar produto</title>
@endsection

@section('insert_body')
    <header>
        <a href="{{route('listagem_produtos')}}" class="logo">
            <img src="{{ asset('images/mercado-libre.png') }}" alt="">
        </a>
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
@endsection
