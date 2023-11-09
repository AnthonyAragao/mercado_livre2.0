@extends('templates.template_view')

@section('insert_head')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.min.css" rel="stylesheet">
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
                        <a href="{{route('pedido.index')}}">Compras</a>
                        <a href=""><i class="fa-solid fa-cart-shopping"></i></a>
                    </nav>
                </div>
            @endif
        </div>
    </header>

    <main>
        <div class="container">
            <h2 style="margin-bottom: 14px;">Dê sua opinião e ajude a mais pessoas</h2>

            <div style="display: flex">
                <div style="
                    width: 100%;
                    margin-bottom:20px;
                    background-color: white;
                    border-radius:8px;
                    padding: 15px;
                    gap: 55px;
                    box-shadow: 0 1px 2px 0 rgba(0,0,0,.25);
                    ">

                    <div style="
                        /* display: flex; */
                        width: 100%;
                        margin-top: 10px;
                        background-color: white;
                        border-radius:4px;
                        padding: 15px;
                        gap: 55px">

                        <div style="
                            display: flex;
                            gap: 8px;
                            Justify-content: center;
                            flex-direction: column;
                            align-items: center;">

                            <img src="{{ asset('files/produtos')}}/{{$compra->exemplar[0]->pivo->produto->imagem_01}}"
                            style="
                            width: 125px;
                            border: 1px solid #ededed;
                            border-radius: 50%;
                            padding:10px">

                            <h2 style="margin: 6px 0;">O que você achou desse produto?</h2>

                            <p style="color: #a7a4a4">
                                {{$compra->exemplar->first()->pivo->produto->nome}}
                            </p>
                        </div>

                        <div style="display: flex; gap: 11px; justify-content: center; margin-top: 15px">

                            <div style="display: flex; flex-direction: column;">
                                <a href="" onclick="opinar(1)"><i class="fa-regular fa-star fa-2xl star-list" style="color: #a7a4a4"></i></a>
                                <span style="margin-top: 3px; color: #a7a4a4">Ruim</span>
                            </div>

                            <a href="" onclick="opinar(2)"><i class="fa-regular fa-star fa-2xl star-list" style="color: #a7a4a4"></i></a>
                            <a href="" onclick="opinar(3)"><i class="fa-regular fa-star fa-2xl star-list" style="color: #a7a4a4"></i></a>
                            <a href="" onclick="opinar(4)"><i class="fa-regular fa-star fa-2xl star-list" style="color: #a7a4a4"></i></a>

                            <div style="display: flex; flex-direction: column;">
                                <a href="" onclick="opinar(5)"><i class="fa-regular fa-star fa-2xl star-list" style="color: #a7a4a4"></i></a>
                                <span style="margin-top: 4px; position: relative; right: 17px; color: #a7a4a4">Excelente</span>
                            </div>

                        </div>

                        {{-- <div style="display: flex; align-items: center; text-align:center">
                            <span style="color: #a7a4a4; font-size:14px">Comprado em 05 de nov</span>
                        </div> --}}
                    </div>


                    <div style="display: flex; justify-content: center; padding:15px; flex-direction: column;">
                        <h2 style="font-size: 20px; margin-bottom: 9px;  text-align: center;">Dê mais detalhes sobre o seu produto</h2>
                        <textarea name="" id="" rows="5"
                            style="
                            width: 100%;
                            border: 2px solid #ededed;
                            border-radius: 8px;
                            padding: 15px"
                            placeholder="Eu achei que o meu produto..."></textarea>


                            <div style="
                                display: flex;
                                justify-content: center;
                                margin-top: 20px;">
                                <a href=""
                                    style="
                                    padding: 10px 15px;
                                    background-color: rgb(52, 131, 250);
                                    color: #fff;
                                    border-radius: 4px;
                                    border: none;
                                    text-decoration: none;
                                    ">Salvar</a>
                            </div>
                    </div>

                </div>
            </div>
        </div>
    </main>
@endsection


@section('insert_script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css" rel="stylesheet">


    <script>
        function opinar(id){
            event.preventDefault();
            const stars = document.querySelectorAll('.star-list');

            // Seta as configurações das estrelas para o padrão inicial antes de preencher com as cores
            stars.forEach(star => {
                if (star.classList.contains('fa-solid')) {
                    star.classList.remove('fa-solid');
                    star.classList.add('fa-regular');
                    star.style.color = '#a7a4a4';
                }
            });

            for (let i=0; i<id; i++)  {
                stars[i].classList.add('fa-solid');
                stars[i].style.color = 'rgb(52, 131, 250)';
            }
        }
    </script>

@endsection
