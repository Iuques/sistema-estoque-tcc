@extends('layouts.products')
@section('title', 'Editar fornecedor')
@section('content')


<div class="col-md-6 offset-md-3" id="supplier-edit-container">
    <div class="text-center">
        <h1>Editando fornecedor: {{$supplier->name}}</h1>
    </div>
    <form action="/products/suppliers/update/{{$supplier->id}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name"><b>Nome:</b></label>
            <input type="text" id="name" name="name" class="form-control" value="{{$supplier->name}}">
        </div>
        <br>
        <div class="form-group">
            <label for="contact"><b>Contato:</b></label>
            <input type="text" id="contact" name="contact" class="form-control" value="{{$supplier->contact}}">
        </div>
        <br>
        <div class="form-group">
            <label for="address"><b>Endereço:</b></label>
            <input type="text" id="address" name="address" class="form-control" value="{{$supplier->address}}">
        </div>
        <br>
        <div class="form-group text-center">
            <input type="submit" class="btn btn-primary btn-lg" value="Editar" style="width: 200px">
        </div>
    </form>
</div>
<div class="back">
    <a class="btn btn-danger btn-sm" href="/products/suppliers"><i class='bx bx-arrow-back'></i> Voltar</a>
</div>

@endsection
