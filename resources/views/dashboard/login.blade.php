@extends('layouts.login')
@section('title', 'Login')
@section('content')

@if ($cadastra == true)
    <div class="col-md-6 offset-md-3" id="user-create-container">
        <h1>Cadastrar usuário</h1>
        <form action="/dashboard/store" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nome:</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Nome do usuário">
            </div>
            <div class="form-group">
                <label for="surname">Sobrenome:</label>
                <input type="text" id="surname" name="surname" class="form-control" placeholder="Sobrenome do usuário">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="seuemail@seuemail.com">
            </div>
            <div class="form-group">
                <label for="password">Senha:</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Senha do usuário">
            </div>
            <input type="hidden" name="type" value="1">
            <input type="submit" class="btn btn-primary" value="criar usuario">
        </form>
    </div>
@else
    <div class="col-md-6 offset-md-3" id="login-container">
        <h1>Efetuar login</h1>

        @if ($errors->all())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger" role="alert">
                    {{$error}}
                </div>
            @endforeach
        @endif
        <form action="/dashboard/login/do" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Seu email">
            </div>
            <div class="form-group">
                <label for="password">Senha:</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Sua senha">
            </div>
            <div class="form-group">
                <label for="remember">Lembrar de mim</label>
                <input type="checkbox" id="remember" name="remember">
            </div>
            <input type="submit" class="btn btn-primary" value="login">
        </form>
    </div>
@endif

@endsection
