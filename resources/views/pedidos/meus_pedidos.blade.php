@extends('templates.template_view')

@section('insert_head')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/meus_pedidos.css') }}">
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
                <div>
                    <nav>
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
        <div class="container-requests">
            <h2>Compras</h2>

            <div class="comment-block">
                <span>
                    <i class="fa-solid fa-star"></i> Alguns produtos esperam sua opinião
                </span>
            </div>

            @foreach ($compras as $compra)
                <div class="shopping">
                    <div class="date">
                        <p>
                            <?php
                                $meses = array(
                                    'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho',
                                    'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'
                                );

                                $timestamp = strtotime($compra->data);
                                $dia = date("j", $timestamp);
                                $mes = $meses[date("n", $timestamp) - 1];

                                echo $dia . " de " . $mes;
                            ?>
                        </p>
                    </div>

                    <div class="details">
                        <div class="details-img">
                            <div>
                                <img src="{{ asset('files/produtos')}}/{{$compra->exemplar[0]->pivo->produto->imagem_01}}">
                            </div>

                            <span>
                                {{$compra->exemplar[0]->pivo->produto->nome}}
                            </span>
                        </div>

                        <div class="details-producer">
                            <span>
                                <?php echo strtoupper($compra->exemplar[0]->pivo->produtor->dados_empresa->nome); ?>
                            </span>

                            <a href="">Enviar mensagem</a>
                        </div>

                        <div class="container-btns">
                            <a href="{{route('pedido.show', [Crypt::encrypt($compra->id)]) }}">
                                <button class="btn" style="background-color: #3783f7; color: white; width: 100%;">
                                    Ver compra
                                </button>
                            </a>

                            @if (count($compra->avaliacao) === 0)
                                <a href="{{route('reviews.create', [Crypt::encrypt($compra->id)] )}}" class="btn" style="width: 100%; background-color:rgba(65,137,230,.15); color: #3483fa">
                                    Opinar
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </main>
@endsection


@section('insert_script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css" rel="stylesheet">

    @if (session('check'))
        <script>
            Swal.fire({
                title: 'Avaliação feita',
                text: "Agradeçemos pelo seu Feedback",
                icon: "success",
                showConfirmButton: false,
                timer: 2000
            })
        </script>
    @endif
@endsection
