<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
        <link rel="icon" href="{{asset('images/icon-mercado-libre.png')}}">
        <title>Mercado libre</title>
    </head>

    <body>
        <header>
            <div class="logo">
                <img src="{{ asset('images/mercado-libre.png') }}" alt="">
                @if (Route::has('login'))
                    <div class="">
                        @auth
                            <a href="{{ url('/dashboard') }}">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}">Log in</a>
                        @endauth
                    </div>
                @endif
            </div>
        </header>

        {{-- {{dd($produtos)}} --}}

        <main>
            <div class="container-card">
                @foreach ( $produtos as $produto )
                    <div class="card-product">
                        <a href="">
                            <div class="img-product">
                                <img src="{{ asset('files/produtos')}}/{{$produto->imagem_01}}">
                            </div>

                            <div class="description-product">

                                <div class="price-product" style="margin-bottom: 5px">
                                    <div>
                                        <span style="font-size: 22px">R$ {{ number_format($produto->preco)}}</span>
                                        <span class="color-green" style="font-size:14px; font-weight: 600;">41% OFF</span>
                                    </div>
                                    <span class="color-green" style="font-size:14px; font-weight: 600;">10x R$ {{ number_format(($produto->preco/10),2,',','.')}} sem juros</span>
                                </div>
                                <span class="color-green" style="font-size:16px; font-weight: 600; margin-bottom: 5px">Frete grátis</span>

                                <p>{{$produto->descricao}}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

        </main>
    </body>
</html>
