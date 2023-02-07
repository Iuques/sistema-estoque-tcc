@extends('layouts.products')
@section('title', 'Editar departamento')
@section('content')


<div class="col-md-6 offset-md-3" id="departament-edit-container">
    <h1>Editar departamento</h1>
    <form action="/products/departaments/update/{{$departament->id}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nome:</label>
            <input type="text" id="name" name="name" class="form-control" value="{{$departament->name}}">
        </div>
        <div class="form-group">
            <label for="description">Descrição:</label>
            <input type="textarea" id="description" name="description" class="form-control" value="{{$departament->description}}">
        </div>
        <input type="submit" class="btn btn-primary" value="editar departamento">
    </form>
</div>

<a class="nav-link" href="/products/departaments">Voltar</a>
@endsection
