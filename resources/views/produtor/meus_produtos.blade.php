@extends('templates.template_view')

@section('insert_head')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <title>Mercado libre</title>
@endsection

@section('insert_body')
    <header>
        <div class="logo">
            <a href="{{route("listagem_produtos")}}" style="height: 100%">
                <img src="{{ asset('images/mercado-libre.png') }}" alt="">
            </a>

            <form action="{{route('produto.search')}}" method="GET">
                <div style="display: flex">
                    <input type="text" class="search" name="query" placeholder="Buscar produtos, marcas e muito mais...">
                    <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </form>

            @if (Route::has('login'))
                <div>
                    <nav style="">
                        @auth
                            <a href="{{ url('/dashboard') }}">Dashboard</a>

                            <a href="{{route('produto.indexAuth')}}">Meus produtos</a>
                        @else
                            <a href="{{ route('registration') }}">Crie a sua conta</a>
                            <a href="{{ route('login') }}">Entre</a>
                        @endauth
                        <a href="">Compras</a>
                        <a href=""><i class="fa-solid fa-cart-shopping"></i></a>
                    </nav>
                </div>
            @endif
        </div>
    </header>


    <main>
        {{-- {{dd($produtos[3]-)}} --}}
        <div style="width: 1180px; background-color:#fff; margin:60px; border-radius:8px; display:flex; flex-direction:column; position: relative;">

            <a href="{{route('produto.create')}}" style="position: absolute; top:-50px">
                <button class="btn btn-success" style="">Cadastrar Produto</button>
            </a>


            <div style="display: flex; background-color: rgb(77, 77, 77); color: #fff; border-radius: 4px 4px 0 0" >
                <div style="width: 420px; display:flex; justify-content: center; align-items: center;">
                    <p style=" margin-top: 11px;">Nome</p>
                </div>

                <div style="width: 240px; display:flex; justify-content: center; align-items: center;">
                    <p style=" margin-top: 11px;">Preço</p>
                </div>

                <div style="width: 240px; display:flex; justify-content: center; align-items: center;">
                    <p style=" margin-top: 11px;">Unidades</p>
                </div>

                <div style="width: 240px; display:flex; justify-content: center; align-items: center;">
                    <p style=" margin-top: 11px;">Vendas</p>
                </div>

                <div style="width: 240px; display:flex; justify-content: center; align-items: center;">
                    <p style=" margin-top: 11px;">Ações</p>
                </div>
            </div>

            @foreach ($produtos as $produtoDaLista)
                <div style="display:flex; border-bottom: 1px solid #ededed;">
                    <div style="width: 420px; height:100%; display:flex; border-right: 1px solid #ededed">
                        <div style="padding:10px">
                            <img src="{{ asset('files/produtos')}}/{{$produtoDaLista->produto->imagem_01}}" style="width: 80px">
                        </div>

                        <div style="display:flex; justify-content: center; align-items: center;">
                            <p>{{$produtoDaLista->produto->nome}}</p>
                        </div>
                    </div>

                    <div style="width: 240px; display:flex; justify-content: center; align-items: center; border-right: 1px solid #ededed">
                        <span class="discount-price">R$ {{ number_format(($produtoDaLista->produto->preco_desconto),2,',','.')}}</span>
                    </div>

                    <div style="width: 240px; height:100%; display:flex; justify-content: center; align-items: center; border-right: 1px solid #ededed">
                        <span>{{$produtoDaLista->produto->estoque}} unidades</span>
                    </div>

                    <div style="width: 240px; height:100%; display:flex; justify-content: center; align-items: center; border-right: 1px solid #ededed">
                        <span>{{$produtoDaLista->produto->vendas}} Vendas</span>
                    </div>

                    <div style="width: 240px; height:100%; display:flex; justify-content: center; align-items: center; flex-direction: column;">
                        <a href="{{route('produto.edit', [Crypt::encrypt($produtoDaLista->produto->id)])}}" style="text-decoration: none">Editar</a>
                        <form action="{{ route('produto.destroy', [Crypt::encrypt($produtoDaLista->produto->id)]) }}" id="form" method="POST">
                            @csrf
                            @method('DELETE')
                            <a href="" onclick="excluirProduto(event)" style="text-decoration: none">Excluir</a>
                        </form>
                    </div>

                </div>
            @endforeach
        </div>
    </main>
@endsection


@section('insert_script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css" rel="stylesheet">

    <script>
        function excluirProduto(event){
            event.preventDefault();

            Swal.fire({
                title: 'Tem certeza?',
                text: "Você não poderá reverter isso!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, desejo excluir',
                cancelButtonText: 'Não desejo excluir',

                }).then((result) => {
                    if (result.isConfirmed) {
                        const form = document.getElementById('form');
                        form.submit();
                    }
            })
        }
    </script>

    @if (session('check'))
        <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Produto excluído.',
                text: 'Produto deletado com sucesso.',
                showConfirmButton: false,
                timer: 2000
            })
        </script>
    @endif
@endsection
