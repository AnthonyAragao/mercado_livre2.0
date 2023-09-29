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

    {{-- {{dd($produtos)}} --}}

    <main>
        <div class="container-card">
            @foreach ( $produtos as $produto )
                <div class="card-product">
                    <a href="{{route('exibir_produto.show', [Crypt::encrypt($produto->id)] )}}">

                        <div class="img-product" style="position: relative">
                            <div class="heart d-none">
                                <i class="fa-regular fa-heart"></i>
                            </div>
                            <img src="{{ asset('files/produtos')}}/{{$produto->imagem_01}}">
                        </div>

                        <div class="description-product">
                            <span class="previous-price d-none">R$ {{$produto->preco}}</span>
                            <div class="price-product" style="">
                                <div>
                                    <span style="font-size: 22px">R$ {{ number_format(($produto->preco_desconto),0,',','.')}}</span>
                                    <span class="color-green" style="font-size:14px; font-weight: 500;">{{$produto->desconto}}% OFF</span>
                                </div>
                                <span class="color-green" style="font-size:14px; font-weight: 500;">10x R$ {{ number_format(($produto->preco_desconto/10),2,',','.')}} sem juros</span>
                            </div>

                            <span class="color-green" style="font-size:14px; font-weight: 600;">
                                Frete grátis  <span style="font-size:12px; font-weight: 900; font-style:italic"><i class="fa-solid fa-bolt-lightning"></i> FULL</span>
                            </span>

                            <p style="font-size: 14px">{{$produto->descricao}}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </main>
@endsection

@section('insert_script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.all.min.js"></script>
    @if (session('check'))
        <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Parabéns!!!',
                text: 'Produto cadastro com sucesso.',
                showConfirmButton: false,
                timer: 2000
            })
        </script>
    @endif
@endsection
