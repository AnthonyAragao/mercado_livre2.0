@extends('templates.template_view')

@section('insert_head')
    <link rel="stylesheet" href="{{ asset('css/show_produto.css') }}">
@endsection

@section('insert_body')
    <header>
        <div class="logo">
            <img src="{{ asset('images/mercado-libre.png') }}" alt="">
        </div>
    </header>

    <main>
        <div class="container-product">
            <div class="card-img-product">
                <div class="container-imgs-small">
                    @if (isset($produto->imagem_01))
                        <div class="img-small border-blue">
                            <img src="{{ asset('files/produtos')}}/{{$produto->imagem_01}}">
                        </div>
                    @endif

                    @if (isset($produto->imagem_02))
                        <div class="img-small">
                            <img src="{{ asset('files/produtos')}}/{{$produto->imagem_02}}">
                        </div>
                    @endif

                    @if (isset($produto->imagem_03))
                        <div class="img-small">
                            <img src="{{ asset('files/produtos')}}/{{$produto->imagem_03}}">
                        </div>
                    @endif

                    @if (isset($produto->imagem_04))
                        <div class="img-small">
                            <img src="{{ asset('files/produtos')}}/{{$produto->imagem_04}}">
                        </div>
                    @endif

                    @if (isset($produto->imagem_05))
                        <div class="img-small">
                            <img src="{{ asset('files/produtos')}}/{{$produto->imagem_05}}">
                        </div>
                    @endif
                </div>

                <div class="img-product">
                    <img src="{{ asset('files/produtos')}}/{{$produto->imagem_01}}">
                </div>
            </div>

            <div class="container-description-product">
                <h1>{{$produto->nome}}</h1>

                <div class="card-information-product">
                    <span class="price-product">R$ {{$produto->preco}}</span>
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
                        Armazenado e enviado pelo<span><i class="fa-solid fa-bolt-lightning"></i> FULL</span>
                    </p>

                    <div class="available-stock">Quantidade: 1 unidade
                        <span>({{$produto->estoque}} disponíveis)</span>
                    </div>

                    <div>
                        <a href="">
                            <button class="call-action">Comprar</button>
                        </a>

                        <button class="add-cart">
                            Adicionar ao carrinho
                        </button>
                    </div>

                    <div class="card-information-buy">
                        <div>
                            <i class="fa-solid fa-share fa-rotate-180" style="color: rgba(0,0,0,.55);"></i>
                        </div>

                        <div class="information-about">
                            <a href="">Devolução grátis.</a>
                            <span>Você tem 7 dias a partir da data de recebimento.</span>
                        </div>
                    </div>

                    <div class="card-information-buy">
                        <div>
                           <i class="fa-solid fa-shield-halved" style="color: rgba(0,0,0,.55);"></i>
                        </div>

                        <div class="information-about">
                            <a href="">Compra Garantida.</a>
                            <span>receba o produto que está esperando ou devolvemos o dinheiro.</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
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
