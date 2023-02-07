@extends('layouts.products')
@section('title', 'Cadastrar fornecedor')
@section('content')


<div class="col-md-6 offset-md-3" id="supplier-create-container">
    <h1>Cadastrar fornecedor</h1>
    <form action="/products/suppliers/store" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nome:</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Nome do fornecedor">
        </div>
        <div class="form-group">
            <label for="contact">Contato:</label>
            <input type="text" id="contact" name="contact" class="form-control" placeholder="Contato do fornecedor">
        </div>
        <div class="form-group">
            <label for="address">Endereço:</label>
            <input type="text" id="address" name="address" class="form-control" placeholder="Endereço do fornecedor">
        </div>
        <input type="submit" class="btn btn-primary" value="criar fornecedor">
    </form>
</div>

<a class="nav-link" href="/products/suppliers">Voltar</a>
@endsection
