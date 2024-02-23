@extends('templates.template_view')

@section('insert_head')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/reviews.css') }}">
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
        <form method="POST" action="{{route('reviews.store')}}">
        @csrf
            <div class="container">
                <h2 >Dê sua opinião e ajude a mais pessoas</h2>

                <div class="d-flex">
                    <div class="card-product">
                        <div class="details-product">

                            <div class="img-product">
                                <img src="{{ asset('files/produtos')}}/{{$compra->exemplar[0]->pivo->produto->imagem_01}}">

                                <h2>O que você achou desse produto?</h2>

                                <p>{{$compra->exemplar->first()->pivo->produto->nome}}</p>
                            </div>

                            <div class="container-stars">
                                <div class="star-avaliation">
                                    <a href="" onclick="opinar(1)"><i class="fa-regular fa-star fa-2xl star-list"></i></a>
                                    <span>Ruim</span>
                                </div>

                                <a href="" onclick="opinar(2)"><i class="fa-regular fa-star fa-2xl star-list"></i></a>
                                <a href="" onclick="opinar(3)"><i class="fa-regular fa-star fa-2xl star-list"></i></a>
                                <a href="" onclick="opinar(4)"><i class="fa-regular fa-star fa-2xl star-list"></i></a>

                                <div class="star-avaliation">
                                    <a href="" onclick="opinar(5)"><i class="fa-regular fa-star fa-2xl star-list"></i></a>
                                    <span>Excelente</span>
                                </div>
                            </div>

                            <input type="hidden" id="avaliacao" name="avaliacao" value="0">
                            <input type="hidden" id="avaliacao" name="compra" value="{{Crypt::encrypt($compra->id)}}">
                            <input type="hidden" id="avaliacao" name="produto" value="{{Crypt::encrypt($compra->exemplar->first()->pivo->produto->id)}}">
                        </div>

                        <div class="container-comment">
                            <h2>Dê mais detalhes sobre o seu produto</h2>
                            <textarea name="opiniao" id="" rows="5" placeholder="Eu achei que o meu produto..."></textarea>

                            <div class="btn">
                                <button type="submit">Salvar</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </form>
    </main>
@endsection


@section('insert_script')
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css" rel="stylesheet"> --}}

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

            document.getElementById('avaliacao').value = id;
        }
    </script>
@endsection
