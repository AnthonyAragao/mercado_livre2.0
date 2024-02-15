@extends('templates.template_view')

@section('insert_head')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/show_produto.css') }}">
@endsection

@section('insert_body')
    <header>
        <div class="logo">
            <a href="{{route('listagem_produtos')}}">
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

    <main>
        <div class="container-product">
            <div class="d-flex">
                <div class="card-img-product">
                    <div class="container-imgs-small">
                        @for ($i = 1; $i <= 5; $i++)
                            @php
                                $imageProperty = "imagem_0" . $i;
                                $imageSrc = data_get($produto, $imageProperty);
                            @endphp

                            @if (isset($imageSrc))
                                <div class="img-small @if ($i == 1) border-blue @endif">
                                    <img src="{{ asset('files/produtos/' . $imageSrc) }}">
                                </div>
                            @endif
                        @endfor
                    </div>

                    <div class="img-product">
                        <img src="{{ asset('files/produtos')}}/{{$produto->imagem_01}}">
                    </div>
                </div>

                <div class="container-description-product">
                    <h1>{{$produto->nome}}</h1>

                    <div class="card-information-product">
                        <span class="price-product">R$ {{ number_format(($produto->preco),2,',','.')}} </span>
                        <div>
                            <span class="discount-price">R$ {{ number_format(($produto->preco_desconto),0,',','.')}}</span>
                            <span  class="discount">{{$produto->desconto}}% OFF</span>
                        </div>

                        <span class="installment">10x R$ {{ number_format(($produto->preco_desconto/10),2,',','.')}} sem juros</span>
                    </div>

                    <a href="">Ver os meios e pagamento</a>

                    <div class="offer-day">
                        OFERTA DO DIA
                    </div>
                </div>

                <div class="container-details">
                    <div class="card-details">
                        {{-- <p style="font-size: 16px; color: #00a650; font-weight: 600;">Frete grátis</p> --}}
                        <p class="stock">Estoque disponível</p>
                        <p class="description-stored">
                            Armazenado e enviado pelo <span><i class="fa-solid fa-bolt-lightning"></i> FULL</span>
                        </p>

                        <div class="available-stock">Quantidade: 1 unidade
                            <span>({{$produto->estoque}} disponíveis)</span>
                        </div>

                        @auth
                            <a href="" style="color:#013b93">
                                <div class="send">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <span>Enviar para {{Auth::user()->printEndereco()}}</span>
                                </div>
                            </a>
                        @endauth

                        <div>
                            <a href="{{route('metodo-pagamento', [Crypt::encrypt($produto->id)])}}">
                                <button type="submit" class="btn call-action">Comprar</button>
                            </a>

                            <button class="btn add-cart">Adicionar ao carrinho</button>
                        </div>

                        <div class="card-information-buy">
                            <div><i class="fa-solid fa-share fa-rotate-180"></i></div>

                            <div class="information-about">
                                <a href="">Devolução grátis.</a>
                                <span>Você tem 7 dias a partir da data de recebimento.</span>
                            </div>
                        </div>

                        <div class="card-information-buy">
                            <div><i class="fa-solid fa-shield-halved"></i></div>

                            <div class="information-about">
                                <a href="">Compra Garantida.</a>
                                <span>receba o produto que está esperando ou devolvemos o dinheiro.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if (count($avaliacoes) !== 0)
                <div class="line" ></div>

                <div class="container-assessment-external">
                    <div class="container-assessment-internal">
                        <div>
                            <h2 class="assessment-product">Opiniões do produto</h2>

                            @foreach ($avaliacoes->take(5) as $avaliacao)
                                <div class="line"></div>

                                <div class="container-icon-user">
                                    <div class="icon-user">
                                        <i class="fa-regular fa-user"></i>
                                    </div>

                                    <span> {{ $avaliacao->compra->usuario->dado_acesso->nome }} </span>
                                </div>

                                <div class="container-stars">
                                    <div>
                                        @php
                                            $numEstrelas = 5; // Número total de estrelas
                                            $starsBlue = $avaliacao->status->id; // Número de estrelas azuis com base na avaliação
                                        @endphp

                                        @for ($i = 0; $i < $numEstrelas; $i++)
                                            @if ($starsBlue > 0)
                                                <i class="fa-solid fa-star fa-xs color-stars-blue"></i>
                                                @php $starsBlue-- @endphp
                                            @else
                                                <i class="fa-regular fa-star fa-xs color-stars-black"></i>
                                            @endif
                                        @endfor
                                    </div>

                                    <div>
                                        <span class="formatted-date">{{ \Carbon\Carbon::parse($avaliacao->data)->format('d M. Y') }}</span>
                                    </div>
                                </div>

                                <p class="comment">{{ $avaliacao->comentario }}</p>

                                <div class="container-btns-feedback">
                                    <div class="feedback-like">
                                        <span>É útil <i class="fa-regular fa-thumbs-up"></i></span>
                                    </div>

                                    <div class="feedback-dislike">
                                        <i class="fa-regular fa-thumbs-up fa-flip-vertical"></i>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </main>

    <div class="centralize-container-product">
        <div class="container-product-category">
            <h2>Quem comprou este produto tambem comprou</h2>

            @foreach ( $produtosCategoria->take(5) as $produto )
                <div class="card-product-category">
                    <a href="{{route('exibir_produto.show', [Crypt::encrypt($produto->id)] )}}">
                        <div class="img-product-category">
                            <div class="heart d-none">
                                <i class="fa-regular fa-heart"></i>
                            </div>

                            <img src="{{ asset('files/produtos')}}/{{$produto->imagem_01}}">
                        </div>

                        <div class="description-product">
                            <span class="previous-price d-none">R$ {{$produto->preco}}</span>

                            <div>
                                <span style="font-size: 22px">R$ {{ number_format(($produto->preco_desconto),0,',','.')}}</span>
                                <span class="color-green font-weight-500">{{$produto->desconto}}% OFF</span>
                            </div>

                            <span class="color-green font-weight-500">10x R$ {{ number_format(($produto->preco_desconto/10),2,',','.')}} sem juros</span>

                            <span class="color-green font-weight-600">
                                Frete grátis  <span class="discount-full"><i class="fa-solid fa-bolt-lightning"></i> FULL</span>
                            </span>

                            <p>{{$produto->descricao}}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection


@section('insert_script')
    <script>
        const imgContainers = document.querySelectorAll('.img-small');
        const imgProduct = document.querySelector('.img-product');

        imgContainers.forEach((container) => {
            container.addEventListener("mouseover", () => {
                // Remove a classe "border-blue" de todos os elementos
                imgContainers.forEach((otherContainer) => {
                    otherContainer.classList.remove('border-blue');
                });

                // Adiciona a classe "border-blue" ao elemento pai do evento de mouseover
                container.classList.add('border-blue');

                const imgSrc = container.querySelector('img').src;
                imgProduct.querySelector('img').src = imgSrc; // Atualiza a imagem na .img-product
            });
        });
    </script>
@endsection
