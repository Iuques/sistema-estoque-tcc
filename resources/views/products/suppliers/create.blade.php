@extends('layouts.products')
@section('title', 'Cadastrar fornecedor')
@section('content')


<div class="col-md-6 offset-md-3" id="supplier-create-container">
    <div class="text-center">
        <h1>Cadastrar fornecedor</h1>
    </div>
    <form action="/products/suppliers/store" method="POST">
        @csrf
        <div class="form-group">
            <label for="name"><b>Nome:</b></label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Nome do fornecedor">
        </div>
        <br>
        <div class="form-group">
            <label for="contact"><b>Contato:</b></label>
            <input type="text" id="contact" name="contact" class="form-control" placeholder="Contato do fornecedor">
        </div>
        <br>
        <div class="form-group">
            <label for="address"><b>Endereço:</b></label>
            <input type="text" id="address" name="address" class="form-control" placeholder="Endereço do fornecedor">
        </div>
        <br>
        <div class="form-group text-center">
            <input type="submit" class="btn btn-primary btn-lg" value="Cadastrar" style="width: 200px">
        </div>
    </form>
</div>
<div class="back">
    <a class="btn btn-danger btn-sm" href="/products/suppliers"><i class='bx bx-arrow-back'></i> Voltar</a>
</div>

@endsection
