@extends('templates.template_view')

@section('insert_head')
    <link rel="stylesheet" href="{{ asset('css/registration.css') }}">
    <title>Vamos te pedir alguns dados para criar sua conta</title>
@endsection

@section('insert_body')
    <header>
        <a href="{{route('listagem_produtos')}}" class="logo">
            <img src="{{ asset('images/mercado-libre.png') }}" alt="">
        </a>
    </header>

    <main>
        <div class="container-card">
            <h1>Vamos te pedir alguns dados para criar sua conta</h1>
            <span>Leva só alguns minutos.</span>

            <label class="checkbox-label">
                <input type="checkbox" class="checkbox-input" id="checkbox-input">
                Aceito os <a href="">Termos e Condições</a> e autorizo o uso de meus dados de acordo com a
                <a href="">Declaração de Privacidade</a>.
            </label>

            <div class="btns">
                <button type="button" id="create_pessoal" onclick="checkboxMarcado()">
                    <a href="{{route('usuarios.create')}}">Criar conta pessoal</a>
                </button>

                <button type="button" id="create" onclick="checkboxMarcado()">
                    <a href="{{route('produtor.create')}}">Criar conta empresa</a>
                </button>
            </div>
        </div>
    </main>
@endsection

@section('insert_script')
    <script>
        function checkboxMarcado(e){
            const containerCheckbox = document.querySelector('.checkbox-label');
            const checkbox = document.getElementById('checkbox-input');

            if(!checkbox.checked){
                event.preventDefault(e);
                containerCheckbox.classList.add('checkbox-label-error');
            }
        }
    </script>
@endsection
