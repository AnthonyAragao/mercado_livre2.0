@extends('templates.template_view')

@section('insert_head')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>

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
                <div class="d-flex">
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

    {{-- {{dd($produtos)}} --}}

    <main>
        <div class="swiper">
            <div class="swiper-wrapper">
                <!-- Slides -->
                @for ($i = 1; $i <= 7; $i++)
                    <div class="swiper-slide" ><img src="{{asset("images/slide0". $i .".webp")}}" alt=""></div>
                @endfor
            </div>

            <div class="swiper-pagination"></div>

            <div class="swiper-button-prev btn-background-white d-none"></div>
            <div class="swiper-button-next btn-background-white d-none"></div>

            <div class="gradient"></div>
        </div>

        <div class="container">
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
        </div>

        <div class="content-benefits">
            <h2>Benefícios em conteúdo</h2>

            <div class="benefits-container">
                <div class="benefit-card">
                    <img src="{{asset("images/disney.jpg")}}" alt="">

                    <div class="benefit-info">
                        <div class="benefit-logo"><img src="{{asset("images/disney-logo.jpg")}}" alt=""></div>

                        <div class="benefit-details">
                            <span class="benefit-name">Sem custo com Meli+</span>
                            <span class="benefit-description">Disney+ e Star+</span>
                        </div>
                    </div>

                    <div class="gradient-gray"></div>
                </div>

                <div class="benefit-card">
                    <img src="{{asset("images/HBOMax.jpg")}}" alt="">

                    <div class="benefit-info">
                        <div class="benefit-logo"><img src="{{asset("images/HBO-logo.png")}}" alt=""></div>

                        <div class="benefit-details">
                            <span class="benefit-name">Até 30% OFF</span>
                            <span class="benefit-description">HBO Max</span>
                        </div>
                    </div>

                    <div class="gradient-blue"></div>
                </div>
            </div>
        </div>
    </main>

    <section>
        <div class="container-category">
            <h2>Categorias populares</h2>

            @foreach ($categorias as $categoria)
                <div class="container-card-category">
                    <a href="{{route('produto.categories', Crypt::encrypt($categoria['id']) )}}">
                        <div class="img-category">
                            <i class="fa-solid {{$categoria['icon']}} fa-2xl"></i>
                        </div>
                        <span>{{$categoria['nome']}}</span>
                    </a>
                </div>
            @endforeach
        </div>
    </section>

    <section class="info-details">
        <div class="container-details">
            <div class="info-slide">
                <div class="img-container">
                    <i class="fa-solid fa-credit-card fa-2xl"></i>
                </div>

                <div class="container-texts">
                    <h2>Escolha como pagar</h2>
                    <span>Com o Mercado Pago, você paga com cartão, boleto ou Pix. Você também pode pagar em até 12x no boleto com o Mercado Crédito.</span>
                    <a href="">Como pagar com Mercado Pago</a>
                </div>
            </div>

            <div class="info-slide feature-left">
                <div class="img-container">
                    <i class="fa-solid fa-gift fa-2xl"></i>
                </div>

                <div class="container-texts">
                    <h2>Frete grátis a partir de R$ 79</h2>
                    <span>Ao se cadastrar no Mercado Livre, você tem frete grátis em milhares de produtos.</span>
                    <a href="">Consulte os Termos e Condições</a>
                </div>
            </div>

            <div class="info-slide feature-left">
                <div class="img-container">
                    <i class="fa-solid fa-shield-halved fa-2xl"></i>
                </div>

                <div class="container-texts">
                    <h2>Segurança, do início ao fim</h2>
                    <span>Você não gostou do que comprou? Devolva! No Mercado Livre não há nada que você não possa fazer, porque você está sempre protegido.</span>
                    <a href="">Como te protegemos</a>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('insert_script')
    @if (session('check'))
        <script>
            Swal.fire({
                title:  "{{ session('check')['title'] }}",
                text:  "{{ session('check')['mensagem'] }}",
                icon: "success",
                showConfirmButton: false,
                timer: 2000,
                onClose: () => {
                    setTimeout(() => {
                        @php session()->forget('check'); @endphp
                    }, 1000); // Atraso de 1 segundo para garantir que o modal seja fechado antes de remover a sessão
                }
            });
        </script>
    @endif


    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        const swiper = new Swiper('.swiper', {
            slidesPerView: 1,
            spaceBetween: 0,
            loop: true,
            autoplay: {
                delay: 2500,
            },

            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },

            pagination: {
                el: '.swiper-pagination',
            },
        });

        const slides = document.querySelector('.swiper');
        const btnPrev = document.querySelector('.swiper-button-prev');
        const btnNext = document.querySelector('.swiper-button-next');

        slides.addEventListener('mouseover', () => {
            btnPrev.classList.remove('d-none');
            btnNext.classList.remove('d-none');
        });

        slides.addEventListener('mouseout', () => {
            btnPrev.classList.add('d-none');
            btnNext.classList.add('d-none');
        });
    </script>
@endsection
