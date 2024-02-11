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
            <div style="margin-top: 30px; width: 800px; display:flex; flex-direction: column;">
                <h2 style="font-size: 18px; margin-bottom:30px">Como você prefere pagar?</h2>

                <a href="{{ route('session', [Crypt::encrypt($produto->id), 'card']) }}"
                    style="
                        width: 100%;
                        height:80px;
                        background-color: #fff;
                        cursor:pointer;
                        text-decoration:none;
                        display: flex;
                        align-items: center;
                        border: 1px solid #e0e0e0;
                        padding: 0 30px;
                        gap: 20px;"
                    >

                    <div style="height: 50px;  width:50px; background-color:#e0e0e0; border-radius:50%; display:flex;  justify-content: center; align-items: center">
                        <i class="fa-solid fa-credit-card" style="font-size: 24px;"></i>
                    </div>

                    <div>
                        <p style="font-size:14px; color:black">Comprar com Cartão</p>
                    </div>
                </a>

                <a href="{{ route('session', [Crypt::encrypt($produto->id), 'card']) }}"
                    style="
                        width: 100%;
                        height:80px;
                        background-color: #fff;
                        cursor:pointer;
                        text-decoration:none;
                        display: flex;
                        align-items: center;
                        border: 1px solid #e0e0e0;
                        padding: 0 30px;
                        gap: 20px;"
                    >

                    <div style="height: 50px;  width:50px; background-color:#e0e0e0; border-radius:50%; display:flex;  justify-content: center; align-items: center">
                        <i class="fa-solid fa-credit-card" style="font-size: 24px;"></i>
                    </div>

                    <div>
                        <p style="font-size:14px; color:black">Comprar com Cartão</p>
                    </div>
                </a>

                <a href="{{ route('session', [Crypt::encrypt($produto->id), 'card']) }}"
                    style="
                        width: 100%;
                        height:80px;
                        background-color: #fff;
                        cursor:pointer;
                        text-decoration:none;
                        display: flex;
                        align-items: center;
                        border: 1px solid #e0e0e0;
                        padding: 0 30px;
                        gap: 20px;"
                    >

                    <div style="height: 50px;  width:50px; background-color:#e0e0e0; border-radius:50%; display:flex;  justify-content: center; align-items: center">
                        <i class="fa-solid fa-credit-card" style="font-size: 24px;"></i>
                    </div>

                    <div>
                        <p style="font-size:14px; color:black">Comprar com Cartão</p>
                    </div>
                </a>

                <span style="margin-top: 20px; font-size:12px">Com outros meios de pagamento</span>


                <a href="{{ route('session', [Crypt::encrypt($produto->id), 'boleto']) }}"
                    style="
                        width: 100%;
                        height:80px;
                        background-color: #fff;
                        cursor:pointer;
                        text-decoration:none;
                        display: flex;
                        align-items: center;
                        border: 1px solid #e0e0e0;
                        margin-top: 20px;
                        padding: 0 30px;
                        gap: 20px;"
                    >

                    <div style="height: 50px;  width:50px; background-color:#e0e0e0; border-radius:50%; display:flex;  justify-content: center; align-items: center">
                        <i class="fa-brands fa-cc-stripe" style="font-size: 24px;"></i>
                    </div>

                    <div>
                        <p style="font-size:14px; color:black">Boleto</p>
                        <span style="font-size:12px; color:#aaa">Será aprovado em 1 a 2 dias</span>
                    </div>
                </a>
            </div>

            <div style="
                background-color: #f7f7f7;
                width:350px; display:flex;
                justify-content: center;
                flex-direction: column;
                padding: 60px 30px;
                gap: 12px; "
                >
                <p style="font-size: 14px; font-weight: 600;">Resumo da compra</p>

                <hr>

                <div>
                    <div style="display: flex; justify-content: space-between;">
                        <span style="font-size: 14px;">Produto</span>
                        <span style="font-size: 14px;">R$ 259,00</span>
                    </div>

                    <div style="display: flex; justify-content: space-between;">
                        <span style="font-size: 14px;">Frete</span>
                        <span style="font-size: 14px;">Grátis</span>
                    </div>
                </div>

                <hr>

                <div style="display: flex; justify-content: space-between;">
                    <span style="font-size: 14px;">Você pagará</span>
                    <span style="font-size: 14px; font-weight: 600">R$ 259,00</span>
                </div>


            </div>


        </div>
    </main>

@endsection
