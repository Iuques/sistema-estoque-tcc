@extends('layouts.login')
@section('title', 'Cadastrar usuário')
@section('content')

<div class="wrapper" id="user-create-wrapper">
    <div class="container main" id="user-create-container">
        <div class="row" id="user-create-row">
        <header><h1>Cadastrar Usuário<h1></header>
        <form action="/dashboard/store" method="POST">
            @csrf
            <div class="form-group row">
                <div class="col"> 
                    <label for="name"><b>Nome:</b></label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Nome do usuário">
                </div>
                <div class="col">
                    <label for="surname"><b>Sobreome:</b></label>
                    <input type="text" id="surname" name="surname" class="form-control" placeholder="Sobrenome do usuário">
                </div>
            </div>
            <br>
            <div class="form-group">
                <label for="email"><b>Email:</b></label>
                <input type="email" id="email" name="email" class="form-control" placeholder="seuemail@seuemail.com">
            </div>
            <br>
            <div class="form-group">
                <label for="password"><b>Senha:</b></label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Senha do usuário">
            </div>
            <br>
            <br>
            <input type="hidden" name="type" value="1">
            <div class="form-group text-center">
                <input type="submit" class="btn btn-primary btn-lg" value="Criar Usuario">
            </div>
        </form>
        </div>
    </div>
</div>

@endsection
