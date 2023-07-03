<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @if ($mensagem = Session::get('erro'))
        {{$mensagem}}
    @endif

    @if ($errors->any())
        @foreach ($errors->all() as $erro)
            {{$erro}} <br>
        @endforeach
    @endif
    <form method="POST" action="{{route('auth.login')}}">
        @csrf
        Email: <input type="email" name="email">
        senha: <input type="password" name="password">
        <button type="submit">Entrar</button>
    </form>

</body>
</html>
