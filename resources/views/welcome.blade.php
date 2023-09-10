<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.min.css" rel="stylesheet">
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
                        <a href="{{route('produto.show', [Crypt::encrypt($produto->id)] )}}">
                            <div class="img-product">
                                <img src="{{ asset('files/produtos')}}/{{$produto->imagem_01}}">
                            </div>

                            <div class="description-product">
                                <div class="price-product" style="margin-bottom: 5px">
                                    <div>
                                        <span style="font-size: 22px">R$ {{ number_format($produto->preco)}}</span>
                                        <span class="color-green" style="font-size:14px; font-weight: 500;">{{$produto->desconto}}% OFF</span>
                                    </div>
                                    <span class="color-green" style="font-size:14px; font-weight: 500;">10x R$ {{ number_format(($produto->preco/10),2,',','.')}} sem juros</span>
                                </div>

                                <span class="color-green" style="font-size:14px; font-weight: 600; margin-bottom: 5px">
                                    Frete grátis  <span style="font-size:12px; font-weight: 900; font-style:italic"><i class="fa-solid fa-bolt-lightning"></i> FULL</span>
                                </span>

                                <p style="font-size: 14px">{{$produto->descricao}}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

        </main>
    </body>

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

</html>
