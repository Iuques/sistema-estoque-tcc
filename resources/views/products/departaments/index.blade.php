@extends('layouts.products')
@section('title', 'Departamentos')
@section('content')
<h1>Lista de departamentos</h1>

@foreach ($departaments as $departament)
    <p>Nome: {{ $departament->name }}</p>
    <p>Descrição: {{ $departament->description }}</p>
    <form action="/products/departaments/destroy/{{$departament->id}}" method="POST">
        @csrf
        @method("DELETE")
        <input type="submit" class="btn btn-danger" value="excluir">
    </form>
    <a href="/products/departaments/edit/{{$departament->id}}" class="btn btn-info">Editar</a>
    <hr class="border border-primary border-2 opacity-50">
@endforeach

<a class="btn btn-primary" href="/products/departaments/create">Adicionar departamento</a>
@endsection