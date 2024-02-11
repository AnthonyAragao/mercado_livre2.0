@extends('templates.template_view')

@section('insert_head')
    <link rel="stylesheet" href="{{ asset('css/metodo_pagamento.css') }}">
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
                        <a href="{{route('pedido.index')}}">Compras</a>
                        <a href=""><i class="fa-solid fa-cart-shopping"></i></a>
                    </nav>
                </div>
            @endif
        </div>
    </header>


    <main style="padding: 80px">
       <h2>Selecione o metodo de pagamento</h2>

       <form method="POST" action="{{ route('session.post', [Crypt::encrypt($produto->id), 'card']) }}">
            @csrf
            <button type="submit" class="btn call-action">Comprar com Cartão</button>
        </form>


        <form method="POST" action="{{ route('session.post', [Crypt::encrypt($produto->id), 'boleto']) }}">
            @csrf
            <button type="submit" class="btn call-action">Boleto</button>
        </form>
    </main>

@endsection
