@extends('layouts.main')
@section('title', 'Cadastrar usuário')
@section('content')


<div class="col-md-6 offset-md-3" id="user-create-container">
    <div class="text-center">
        <h1>Cadastrar usuário</h1>
    </div>
    <form action="/users/store" method="POST">
        @csrf
        <div class="form-group">
            <label for="name"><b>Nome:</b></label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Nome do usuário" required>
        </div>
        <br>
        <div class="form-group">
            <label for="surname"><b>Sobrenome:</b></label>
            <input type="text" id="surname" name="surname" class="form-control" placeholder="Sobrenome do usuário" required>
        </div>
        <br>
        <div class="form-group">
            <label for="email"><b>Email:</b></label>
            <input type="email" id="email" name="email" class="form-control" placeholder="seuemail@seuemail.com" required>
        </div>
        <br>
        <div class="form-group">
            <label for="password"><b>Senha:</b></label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Senha do usuário" required>
        </div>
        <br>
        <div class="form-group">
            <label for="type"><b>Tipo:</b></label>
            <select id="type" name="type" class="form-select" required>
                <option disabled selected>Selecione um tipo</option>
                <option value="1">Administrador</option>
                <option value="0">Comum</option>
            </select>
        </div>
        <br>
        <div class="form-group text-center">
            <input type="submit" class="btn btn-primary btn-lg" value="Cadastrar" style="width: 200px">
        </div>
    </form>
</div>
<div class="back">
    <a class="btn btn-danger btn-sm" href="/users"><i class='bx bx-arrow-back'></i> Voltar</a>
</div>

@endsection
