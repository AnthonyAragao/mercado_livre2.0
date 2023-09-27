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
                background-color: white;
                border-radius: 4px;
                display: flex">

            {{-- {{dd($produto)}} --}}

            <div style="width: 35%; margin-top:40px; display: flex;"> {{-- <img src="{{ asset('files/produtos')}}/{{$produto->imagem_01}}"> --}}
                <div style="padding-left: 12px; display:flex; flex-direction:column; gap:15px;">
                    @if (isset($produto->imagem_01))
                        <div style="border: 1px solid rgba(0,0,0,.4); border-radius: 3px;width: 54px; cursor:pointer;">
                            <img src="{{ asset('files/produtos')}}/{{$produto->imagem_01}}" style="width: 100%">
                        </div>
                    @endif

                    @if (isset($produto->imagem_02))
                        <div style="border: 1px solid rgba(0,0,0,.4); border-radius: 3px;width: 54px; cursor:pointer;">
                            <img src="{{ asset('files/produtos')}}/{{$produto->imagem_02}}" style="width: 100%">
                        </div>
                    @endif

                    @if (isset($produto->imagem_03))
                        <div style="border: 1px solid rgba(0,0,0,.4); border-radius: 3px;width: 54px; cursor:pointer;">
                            <img src="{{ asset('files/produtos')}}/{{$produto->imagem_03}}" style="width: 100%">
                        </div>
                    @endif

                    @if (isset($produto->imagem_04))
                        <div style="border: 1px solid rgba(0,0,0,.4); border-radius: 3px;width: 54px; cursor:pointer;">
                            <img src="{{ asset('files/produtos')}}/{{$produto->imagem_04}}" style="width: 100%">
                        </div>
                    @endif

                    @if (isset($produto->imagem_05))
                        <div style="border: 1px solid rgba(0,0,0,.4); border-radius: 3px;width: 54px; cursor:pointer;">
                            <img src="{{ asset('files/produtos')}}/{{$produto->imagem_05}}" style="width: 100%">
                        </div>
                    @endif
                </div>


                <div style="margin-top: 16px;">
                    <img src="{{ asset('files/produtos')}}/{{$produto->imagem_01}}" style="width: 100%">
                </div>
            </div>



            <div style="width: 33%; padding-left: 30px; margin-top: 84px">
                <h1
                    style="
                        color: rgba(0,0,0,.9);
                        font-size:22px;">{{$produto->nome}}
                </h1>

                <div style="margin-top: 36px; margin-bottom: 6px">
                    <span style="color: rgba(0,0,0,.55); text-decoration-line: line-through;">R$ {{$produto->preco}}</span>
                    <div>
                        <span style="font-size: 32px">R$ {{ number_format(($produto->preco_desconto),0,',','.')}}</span>
                        <span  style="font-size:18px; font-weight: 500; color: #00a650;">{{$produto->desconto}}% OFF</span>
                    </div>
                    <span style="font-size:18px; font-weight: 500; color: #00a650;">10x R$ {{ number_format(($produto->preco_desconto/10),2,',','.')}} sem juros</span>
                </div>

                <a href="" style="text-decoration: none; color: #2968c8; font-size: 14px;">Ver os meios e pagamento</a>

                <div style="
                    font-size: 12px;
                    background-color: #3483fa;
                    margin-top: 8px;
                    width: 100px;
                    text-align: center;
                    border-radius: 3px;
                    color: #FFF;
                    padding: 2px;">
                    OFERTA DO DIA
                </div>
            </div>


            <div style="width: 32%; padding: 16px">
                <div style="
                    border: 1px solid rgba(0,0,0,.1);
                    border-radius: 10px;
                    width: 100%;
                    padding: 44px 14px ">

                    {{-- <p style="font-size: 16px; color: #00a650; font-weight: 600;">Frete grátis</p> --}}

                    <p style="font-size: 16px; font-weight: 500">Estoque disponível</p>
                    <p style="color: rgba(0,0,0,.55); font-size: 14px">Armazenado e enviado pelo <span style="font-size:12px; color: #00a650; font-weight: 900; font-style:italic"><i class="fa-solid fa-bolt-lightning"></i> FULL</span> </p>

                    <div style="margin: 14px 0; font-size: 16px">Quantidade: 1 unidade
                        <span style="font-size: 12px; color: rgba(0,0,0,.55);">({{$produto->estoque}} disponíveis)</span>
                    </div>


                    <div>
                        <a href="">
                            <button style="border-radius: 8px; font-weight: 600; height:48px">
                                Comprar
                            </button>
                        </a>

                        <button style="background-color:rgba(65,137,230,.15); color: #3483fa; border-radius: 8px; font-weight: 600; height:48px">
                            Adicionar ao carrinho
                        </button>
                    </div>

                    <div style="display:flex; gap:7px; margin-top: 10px">
                        <div>
                            <i class="fa-solid fa-share fa-rotate-180" style="color: rgba(0,0,0,.55);"></i>
                        </div>

                        <div style="display: flex; flex-direction:column">
                            <a href="" style="font-size: 14px; color: #3483fa; text-decoration: none">Devolução grátis.</a>
                            <span style="color: rgba(0,0,0,.55); font-size: 14px">Você tem 7 dias a partir da data de recebimento.</span>

                        </div>
                    </div>

                    <div style="display:flex; gap:7px; margin-top: 10px">
                        <div>
                           <i class="fa-solid fa-shield-halved" style="color: rgba(0,0,0,.55);"></i>
                        </div>

                        <div style="display: flex; flex-direction:column">
                            <a href="" style="font-size: 14px; color: #3483fa; text-decoration: none">Compra Garantida.</a>
                            <span style="color: rgba(0,0,0,.55); font-size: 14px">receba o produto que está esperando ou devolvemos o dinheiro.</span>
                        </div>
                    </div>


                </div>



            </div>

        </div>

    </main>
@endsection
