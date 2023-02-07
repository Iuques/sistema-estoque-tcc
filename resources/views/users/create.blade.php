@extends('layouts.main')
@section('title', 'Cadastrar usuário')
@section('content')


<div class="col-md-6 offset-md-3" id="user-create-container">
    <h1>Cadastrar usuário</h1>
    <form action="/users/store" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nome:</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Nome do usuário" required>
        </div>
        <div class="form-group">
            <label for="surname">Sobrenome:</label>
            <input type="text" id="surname" name="surname" class="form-control" placeholder="Sobrenome do usuário" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="seuemail@seuemail.com" required>
        </div>
        <div class="form-group">
            <label for="password">Senha:</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Senha do usuário" required>
        </div>
        <div class="form-group">
            <label for="type">Tipo:</label>
            <select id="type" name="type" class="form-control" required>
                <option value="1">Administrador</option>
                <option value="0">Comum</option>
            </select>
        </div>
        <input type="submit" class="btn btn-primary" value="criar usuario">
    </form>
</div>

<a class="nav-link" href="/users">Voltar</a>
@endsection
