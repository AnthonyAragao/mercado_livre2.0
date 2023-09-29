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
            <img src="{{ asset('images/mercado-libre.png') }}" alt="">
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
        {{-- {{dd($produtos[1]->produto->nome)}} --}}
    </main>
@endsection
