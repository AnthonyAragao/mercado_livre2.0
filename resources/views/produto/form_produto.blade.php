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
            @if (isset($produto))
                <form method="POST" action="{{ route('produto.update',[Crypt::encrypt($produto->id)]) }}" enctype="multipart/form-data" >
                @method('PUT')
            @else
                <form method="POST" action="{{ route('produto.store') }}" enctype="multipart/form-data" >

            @endif
                @csrf

                <div class="input-box">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" required placeholder="Insira o nome do produto"
                    value="{{$produto->nome ?? old('nome')}}">
                </div>

                <div class="input-group">
                    <div class="input-box">
                        <label for="preco">Preço:</label>
                        <input type="number" step="any" id="preco" name="preco" min="0" required placeholder="Insira o preço do produto"
                        value="{{$produto->preco ?? old('preco')}}">
                    </div>

                    <div class="input-box">
                        <label for="estoque">Estoque:</label>
                        <input type="number" id="estoque" name="estoque" min="0" required placeholder="Insira o estoque disponível"
                        value="{{$produto->estoque ?? old('estoque')}}">
                    </div>
                </div>

                <div class="input-group">
                    <div class="input-box">
                        <label for="desconto">Desconto:</label>
                        <input type="number" id="desconto" name="desconto" min="0" placeholder="Insira o desconto(em porcetagem)"
                        value="{{$produto->desconto ?? old('desconto')}}">
                    </div>
                </div>

                <div class="input-box">
                    <label for="categoria">Categoria:</label>
                    <select class="form-select" aria-label="Categoria" aria-describedby="basic-addon1" name="categoria" id="categoria" style="width: 100%">
                        <option value="{{ isset($produto) ? $produto->categoria_id:''}}" >
                            {{isset($produto) ? $produto->categoria->nome : 'Selecione uma Categoria'}}
                        </option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}">
                                {{ $categoria->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="input-box">
                    <label for="descricao">Descrição do Produto:</label>
                    <input type="text" id="descricao" name="descricao" required placeholder="Insira a descrição do produto"
                    value="{{$produto->descricao ?? old('descricao')}}"
                    style="heigth:100px">
                </div>


                <label for="">Insira as imagens:(Insira no máximo 5 imagens)</label>
                <div class="input-box">
                    <label for="imagens" id="labelInput" style="
                        height: 100px;
                        border: 1px solid rgba(0,0,0,.1);
                        border-radius: 4px;
                        cursor: pointer;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        padding:20px;
                        font-size:14px"> Escolher arquivo(s)
                    </label>

                    <input type="file" class="form-control" id="imagens" name="imagens[]" multiple="multiple"
                        style="display:none">
                </div>

                <div id="selected-files"></div>

                @if (Route::currentRouteName() == 'produto.create')
                    <button type="submit">Cadastrar Produto</button>
                @else
                    <button type="submit">Salvar</button>
                @endif
            </form>
        </div>

    </main>
@endsection

@section('insert_script')
    <script>
        const inputImgs = document.getElementById('imagens');
        const labelInput = document.getElementById('labelInput');

        inputImgs.addEventListener('change', function() {
            const selectedFiles = inputImgs.files;
            let selectedFilesText = '';

            if(selectedFiles.length == 0){
                selectedFilesText = 'Nenhum arquivo selecionado'
            }

            for (let i = 0; i < selectedFiles.length; i++) {
                selectedFilesText += selectedFiles[i].name;
                if (i < selectedFiles.length - 1) {
                    selectedFilesText += ', ';
                }
            }

            labelInput.innerHTML = selectedFilesText;
        });

    </script>
@endsection
