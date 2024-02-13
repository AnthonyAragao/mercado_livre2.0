@extends('templates.template_view')

@section('insert_head')
    <link rel="stylesheet" href="{{ asset('css/metodo_pagamento.css') }}">
    <title>Mercado libre</title>
@endsection

@section('insert_body')
    <header>
        <div class="logo">
            <a href="{{route("listagem_produtos")}}" style="height: 100%">
                <img src="{{ asset('images/mercado-libre.png') }}" alt="">
            </a>

            <a href="">Contato</a>
        </div>
    </header>


    <main>
        <div class="container">
            <div class="methods-payments">
                <h2>Como você prefere pagar?</h2>

                <a href="{{ route('session', [Crypt::encrypt($produto->id), 'card']) }}" class="card-payment">
                    <div class="img-method-payment">
                        <i class="fa-solid fa-credit-card" style="font-size: 24px;"></i>
                    </div>

                    <p>Comprar com Cartão</p>
                </a>

                <span>Com outros meios de pagamento</span>

                <a href="{{ route('session', [Crypt::encrypt($produto->id), 'boleto']) }}"  class="card-payment">
                    <div class="img-method-payment">
                        <i class="fa-brands fa-cc-stripe"></i>
                    </div>

                    <div class="description-method-payment">
                        <p>Boleto</p>
                        <span>Será aprovado em 1 a 2 dias</span>
                    </div>
                </a>
            </div>

            <div class="purchase-details">
                <p>Resumo da compra</p>

                <hr>
                <div>
                    <div class="section-info">
                        <span>Produto</span>
                        <span>R$ {{ number_format($produto->preco_desconto, 2, ',', '.') }}</span>
                    </div>

                    <div class="section-info">
                        <span>Frete</span>
                        <span style="color: #00a650">Grátis</span>
                    </div>
                </div>
                <hr>

                <div class="section-info">
                    <span>Você pagará</span>
                    <span style="font-weight: 600">R$ {{ number_format($produto->preco_desconto, 2, ',', '.') }}</span>
                </div>
            </div>

        </div>
    </main>

@endsection
