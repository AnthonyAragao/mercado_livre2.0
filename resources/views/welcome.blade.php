@extends('templates.template_view')

@section('insert_head')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <title>Mercado libre</title>
@endsection

@section('insert_body')
    {{-- {{dd(Auth::user()->usuario[0]->compra[1]->exemplar[0]->pivo->produto  )}} --}}
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

    {{-- {{dd($produtos)}} --}}

    <main>
        <div class="container-card">
            @foreach ( $produtos->take(5) as $produto )
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

    <section>
        <div class="container-category">
            <h2>Categorias populares</h2>

            <div class="container-card-category">
                <a href="{{route('produto.categories', Crypt::encrypt(1) )}}">
                    <div class="img-category">
                        <i class="fa-solid fa-car fa-2xl"></i>
                    </div>
                    <span>Carros, Motos e Outros</span>
                </a>
            </div>

            <div class="container-card-category">
                <a href="{{route('produto.categories', Crypt::encrypt(2))}}">
                    <div class="img-category">
                        <i class="fa-solid fa-wand-magic-sparkles fa-2xl"></i>
                    </div>
                    <span>Beleza e Cuidado Pessoal</span>
                </a>
            </div>

            <div class="container-card-category">
                <a href="{{route('produto.categories', Crypt::encrypt(3))}}">
                    <div class="img-category">
                        <i class="fa-solid fa-mobile-screen fa-2xl"></i>
                    </div>
                    <span>Celulares e Telefones</span>
                </a>
            </div>

            <div class="container-card-category">
                <a href="{{route('produto.categories', Crypt::encrypt(4))}}">
                    <div class="img-category">
                        <i class="fa-solid fa-shirt fa-2xl"></i>
                    </div>
                    <span>Calçados, Roupas e Bolsas</span>
                </a>
            </div>

            <div class="container-card-category">
                <a href="{{route('produto.categories', Crypt::encrypt(5))}}">
                    <div class="img-category">
                        <i class="fa-solid fa-desktop fa-2xl"></i>
                    </div>
                    <span>Informática</span>
                </a>
            </div>

            <div class="container-card-category">
                <a href="{{route('produto.categories', Crypt::encrypt(6))}}">
                    <div class="img-category">
                        <i class="fa-solid fa-gamepad fa-2xl"></i>
                    </div>
                    <span>Games</span>
                </a>
            </div>

            <div class="container-card-category">
                <a href="{{route('produto.categories', Crypt::encrypt(7))}}">
                    <div class="img-category">
                        <i class="fa-solid fa-spider fa-2xl"></i>
                    </div>
                    <span>Brinquedos e Hobbies</span>
                </a>
            </div>


            <div class="container-card-category">
                <a href="{{route('produto.categories', Crypt::encrypt(8))}}">
                    <div class="img-category">
                        <i class="fa-solid fa-blender-phone fa-2xl"></i>
                    </div>
                    <span>Eletrodomésticos</span>
                </a>
            </div>

            <div class="container-card-category">
                <a href="{{route('produto.categories', Crypt::encrypt(9))}}">
                    <div class="img-category">
                        <i class="fa-solid fa-house fa-2xl"></i>
                    </div>
                    <span>Imóveis</span>
                </a>
            </div>

            <div class="container-card-category">
                <a href="{{route('produto.categories', Crypt::encrypt(10))}}">
                    <div class="img-category">
                        <i class="fa-solid fa-music fa-2xl"></i>
                    </div>
                    <span>Instrumentos Musicais</span>
                </a>
            </div>

            <div class="container-card-category">
                <a href="{{route('produto.categories', Crypt::encrypt(11))}}">
                    <div class="img-category">
                        <i class="fa-solid fa-wrench fa-2xl"></i>
                    </div>
                    <span>Ferramentas</span>
                </a>
            </div>

            <div class="container-card-category">
                <a href="{{route('produto.categories', Crypt::encrypt(12))}}">
                    <div class="img-category">
                        <i class="fa-solid fa-notes-medical fa-2xl"></i>
                    </div>
                    <span>Saúde</span>
                </a>
            </div>

            <div class="container-card-category">
                <a href="{{route('produto.categories', Crypt::encrypt(13))}}">
                    <div class="img-category">
                        <i class="fa-solid fa-camera fa-2xl"></i>
                    </div>
                    <span>Câmeras e Acessórios</span>
                </a>
            </div>

            <div class="container-card-category">
                <a href="{{route('produto.categories', Crypt::encrypt(14))}}">
                    <div class="img-category">
                        <i class="fa-solid fa-book-open fa-2xl"></i>
                    </div>
                    <span>Livros, Revistas e Comics</span>
                </a>
            </div>
        </div>
    </section>


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

    @if (session('checkAtt'))
        <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Produto atualizado.',
                text: 'Produto atualizado com sucesso.',
                showConfirmButton: false,
                timer: 2000
            })
        </script>
    @endif
@endsection
