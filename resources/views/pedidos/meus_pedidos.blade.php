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
        <div style="width: 1180px">
            <h2 style="font-size: 26px; margin: 30px 0;">Compras</h2>

            <div style="
                background-color: white;
                border-radius: 4px;
                margin-bottom:20px;
                padding: 10px 30px;
                display: flex;
                justify-content: space-between;
                align-items: center;">
                <span style="color: rgba(0,0,0,.55);"><i class="fa-solid fa-star"></i> Alguns produtos esperam sua opinião</span>

                <button
                    style="
                    width: 160px;
                    height: 38px;
                    cursor: pointer;
                    border: none;
                    background-color:rgba(65,137,230,.15);
                    transition: .5s;
                    color: #3483fa !important;
                    font-size: .9rem;
                    margin-top: 10px;
                    border-radius: 8px;
                    font-weight: 600;">
                    Opinar
                </button>
            </div>

            @foreach ($compras as $compra)
                <div style="
                    background-color: white;
                    border-radius: 4px;
                    margin-bottom:20px">

                    <div style="
                    padding: 17px 0px 0px 30px;
                    border-bottom: 1px solid #ededed;">
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

                    <div style="
                        padding: 30px;
                        display: flex;
                        gap: 6px;
                        justify-content: space-between;">

                        <div style="display: flex; gap:16px; width:40%;">
                            <div>
                                <img src="{{ asset('files/produtos')}}/{{$compra->exemplar[0]->pivo->produto->imagem_01}}"
                                style="
                                    width: 70px;
                                    height: 70px;
                                    border: 1px solid #ededed;
                                    padding: 2px;
                                    border-radius: 4px;">
                            </div>

                            <span style="font-size: 14px; color: rgba(0,0,0,.55);">
                                {{$compra->exemplar[0]->pivo->produto->nome}}
                            </span>
                        </div>

                        <div style="width:30%; display: flex; flex-direction: column;">
                            <span style="font-size: 14px; color: rgba(0,0,0,.55);">
                                <?php echo strtoupper($compra->exemplar[0]->pivo->produtor->dados_empresa->nome); ?>
                            </span>
                            <a href="" style="text-decoration: none; color: #3483fa">Enviar mensagem</a>
                        </div>

                        <div style="width:15%; display:flex; flex-direction: column; gap:2px">
                            <a href="">
                                <button
                                    style=" width: 100%;
                                    height: 38px;
                                    cursor: pointer;
                                    border: none;
                                    background-color: #3783f7;
                                    transition: .5s;
                                    color: white;
                                    font-size: .9rem;
                                    margin-top: 10px;
                                    border-radius: 8px;
                                    font-weight: 600;">
                                    Ver compra
                                </button>
                            </a>

                            <button
                                style=" width: 100%;
                                height: 38px;
                                cursor: pointer;
                                border: none;
                                background-color:rgba(65,137,230,.15);
                                transition: .5s;
                                color: #3483fa !important;
                                font-size: .9rem;
                                margin-top: 10px;
                                border-radius: 8px;
                                font-weight: 600;">
                                Comprar novamente
                            </button>
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
@endsection
