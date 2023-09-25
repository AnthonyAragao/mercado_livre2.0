@extends('templates.template_view')

@section('insert_head')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endsection

@section('insert_body')
    <header>
        <div class="logo">
            <img src="{{ asset('images/mercado-libre.png') }}" alt="">
        </div>
    </header>

    <main>
        <div style="
                margin: 20px;
                width: 1180px;
                height : 1180px;
                background-color: white;
                border-radius: 8px;

                display: flex">

            {{-- {{dd($produto)}} --}}
            <div style="width: 33%;"> {{-- <img src="{{ asset('files/produtos')}}/{{$produto->imagem_01}}"> --}}
                <div>

                </div>

                <div style="margin-top: 16px">
                    <img src="{{ asset('files/produtos')}}/{{$produto->imagem_01}}">
                </div>
            </div>

            <div style="width: 33%;">

                <h1
                    style="
                        color: rgba(0,0,0,.9);
                        font-size:26px;
                        margin-top:80px">{{$produto->nome}}
                </h1>


                <div style="margin-top: 36px">
                    <span style="text-decoration-line: line-through;">R$ {{$produto->preco}}</span>
                    <div>
                        <span style="font-size: 32px">R$ {{ number_format(($produto->preco_desconto),0,',','.')}}</span>
                        <span  style="font-size:18px; font-weight: 500; color: #00a650;">{{$produto->desconto}}% OFF</span>
                    </div>
                    <span style="font-size:18px; font-weight: 500; color: #00a650;">10x R$ {{ number_format(($produto->preco_desconto/10),2,',','.')}} sem juros</span>

                </div>



            </div>

            <div style="width: 34%; padding: 16px">
                <div style="
                    border: 1px solid rgba(0,0,0,.1);
                    border-radius: 15px;
                    width: 100%;
                    height: 100%">

                    <p style="font-size: 16px; margin-top: 52px">Estoque disponível</p>



                </div>



            </div>

        </div>

    </main>
@endsection
