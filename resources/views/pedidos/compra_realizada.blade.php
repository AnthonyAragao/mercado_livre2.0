@extends('templates.template_view')

@section('insert_head')
    <link rel="stylesheet" href="{{ asset('css/meu_pedidos.css') }}">
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


    <main style="padding: 80px">
        <div style="
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #97ed97;
            border: 1px solid #64e964;
            padding: 40px;
            text-align: center;
            width: 1180px;
            border-radius: 8px;">
            <h2 style="margin-bottom: 4rem; font-size: 2rem; color: #333">Obrigado pela sua compra!</h2>

            <p style="font-size: 1.1rem; margin-bottom:40px">O seu pedido foi aceito e está sendo processado. Você irá receber uma notificação com os detalhes do pedido no seu e-mail.</p>

            <a href="{{route('pedido.show', [Crypt::encrypt($compra->id)])}}">
                <button class="btn" style="
                    background-color: #3783f7;
                    color: white; width: 100%;
                    width:120px">
                    Ver compra
                </button>
            </a>
        </div>
    </main>

@endsection
