@extends('templates.template_view')

@section('insert_head')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <title>Digite seu e-mail, telefone ou usuário do Mercado Libre</title>
@endsection

@section('insert_body')
    <header>
        <div class="logo">
            <img src="{{ asset('images/mercado-libre.png') }}" alt="">
        </div>
    </header>

    <main>
        <div class="main-container">
            <div class="text-primary">
                <h1>Digite seu e-mail, telefone ou usuário do Mercado Livre</h1>
            </div>

            <div class="container-card">
                <div class="erros">
                    @if ($mensagem = Session::get('erro'))
                        {{ $mensagem }}
                    @endif

                    @if ($errors->any())
                        @foreach ($errors->all() as $erro)
                            {{ $erro }} <br>
                        @endforeach
                    @endif
                </div>

                <form method="POST" action="{{ route('auth.login') }}">
                    @csrf
                    <label for="email">E‑mail, telefone ou usuário</label>
                    <input type="email" class="form-control" name="email">

                    <label for="password">Senha</label>
                    <input type="password" class="form-control" name="password">

                    <div class="btns">
                        <button type="submit" class="btn btn-primary mt-2">Entrar</button>

                        <button type="button" class="mt-2" id="create">
                            <a href="{{route('registration')}}">Criar conta</a>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
