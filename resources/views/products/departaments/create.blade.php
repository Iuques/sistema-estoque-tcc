@extends('layouts.products')
@section('title', 'Cadastrar departamento')
@section('content')


<div class="col-md-6 offset-md-3" id="departament-create-container">
    <h1>Cadastrar departamento</h1>
    <form action="/products/departaments/store" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nome:</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Nome do departamento">
        </div>
        <div class="form-group">
            <label for="description">Descrição:</label>
            <input type="textarea" id="description" name="description" class="form-control" placeholder="Descrição do departamento">
        </div>
        <input type="submit" class="btn btn-primary" value="criar departamento">
    </form>
</div>

<a class="nav-link" href="/products/departaments">Voltar</a>
@endsection
