@extends('templates.template_view')

@section('insert_head')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/detalhes_compra.css') }}">
    <title>Mercado libre</title>
@endsection

@section('insert_body')
    <header>
        <div class="logo">
            <a href="{{route("listagem_produtos")}}">
                <img src="{{ asset('images/mercado-libre.png') }}" alt="">
            </a>

            <form action="{{route('produto.search')}}" method="GET">
                <div class="d-flex">
                    <input type="text" class="search" name="query" placeholder="Buscar produtos, marcas e muito mais...">
                    <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </form>

            @if (Route::has('login'))
                <nav>
                    @auth
                        <a href="{{ url('/dashboard') }}">Dashboard</a>
                        <a href="{{route('produto.indexAuth')}}">Meus produtos</a>
                    @else
                        <a href="{{ route('registration') }}">Crie a sua conta</a>
                        <a href="{{ route('login') }}">Entre</a>
                    @endauth
                    <a href="{{route('pedido.index')}}">Compras</a>
                    <a href=""><i class="fa-solid fa-cart-shopping"></i></a>
                </nav>
            @endif
        </div>
    </header>

    <main>
        <div class="container">
            <div class="purchase-details-container">
                <p>Status da compra</p>

                <div class="purchase-details-item">
                    <div>
                        <p class="mb-0">{{$produto->nome}}</p>
                        <a href="">Ver detalhe</a>
                    </div>

                    <div class="product-img">
                        <img src="{{ asset('files/produtos')}}/{{$produto->imagem_01}}">
                    </div>
                </div>

                <div class="section-info-delivery">
                    <p>Seu pacote será entregue na
                        <strong>{{
                            Auth::user()->mora->endereco->logradouro . ', ' .
                            Auth::user()->mora->endereco->bairro . ', ' .
                            Auth::user()->mora->numero
                            }}
                        </strong>Sergipe
                    </p>

                    <a href="{{route('exibir_produto.show', [Crypt::encrypt($produto->id)] )}}">
                        <button class="btn-purchase">Comprar novamente</button>
                    </a>
                </div>
            </div>

            <div class="purchase-details">
                <p>Detalhe da compra</p><hr>

                <div>
                    <div class="section-info">
                        <span>Produto</span>
                        <span>R$ {{ number_format($compra->preco_compra, 2, ',', '.') }}</span>
                    </div>

                    <div class="section-info">
                        <span>Frete</span>
                        <span style="color: #00a650">Grátis</span>
                    </div>
                </div>
                <hr>

                <div class="section-info">
                    <span>Total</span>
                    <span style="font-weight: 600">R$ {{ number_format($compra->preco_compra, 2, ',', '.') }}</span>
                </div>
            </div>
        </div>
    </main>
@endsection
