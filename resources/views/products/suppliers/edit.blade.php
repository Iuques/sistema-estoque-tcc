@extends('layouts.products')
@section('title', 'Editar fornecedor')
@section('content')


<div class="col-md-6 offset-md-3" id="supplier-edit-container">
    <h1>Editar fornecedor</h1>
    <form action="/products/suppliers/update/{{$supplier->id}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nome:</label>
            <input type="text" id="name" name="name" class="form-control" value="{{$supplier->name}}">
        </div>
        <div class="form-group">
            <label for="contact">Contato:</label>
            <input type="text" id="contact" name="contact" class="form-control" value="{{$supplier->contact}}">
        </div>
        <div class="form-group">
            <label for="address">Endereç:</label>
            <input type="text" id="address" name="address" class="form-control" value="{{$supplier->address}}">
        </div>
        <input type="submit" class="btn btn-primary" value="editar fornecedor">
    </form>
</div>

<a class="nav-link" href="/products/suppliers">Voltar</a>
@endsection
