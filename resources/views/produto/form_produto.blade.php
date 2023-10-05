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

                <div class="input-group">
                    <div class="input-box">
                        <label for="preco">Preço:</label>
                        <input type="number" step="any" id="preco" name="preco" min="0" required>
                    </div>

                    <div class="input-box">
                        <label for="estoque">Estoque:</label>
                        <input type="number" id="estoque" name="estoque" min="0" required>
                    </div>
                </div>

                <div class="input-group">
                    <div class="input-box">
                        <label for="desconto">Desconto:</label>
                        <input type="number" id="desconto" name="desconto" min="0">
                    </div>
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
                    <label for="descricao">Descrição do Produto:</label>
                    <input type="text" id="descricao" name="descricao" required
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

                    <input type="file" class="form-control" id="imagens" name="imagens[]" multiple="multiple" required
                        style="display:none">
                </div>

                <div id="selected-files"></div>

                <button type="submit">Cadastrar Produto</button>
            </form>
        </div>

    </main>
@endsection

@section('insert_script'),
    <script>
        const inputImgs = document.getElementById('imagens');
        const labelInput = document.getElementById('labelInput');
        const selectedFilesDisplay = document.getElementById('selected-files');

        inputImgs.addEventListener('change', function() {
            const selectedFiles = inputImgs.files;
            let selectedFilesText = '';

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
