@extends('layouts.products')
@section('title', 'Fornecedores')
@section('content')
<h1>Lista de fornecedores</h1>

@foreach ($suppliers as $supplier)
    <p>Nome: {{ $supplier->name }}</p>
    <p>Contato: {{ $supplier->contact }}</p>
    <p>Endereço: {{ $supplier->address }}</p>
    <form action="/products/suppliers/destroy/{{$supplier->id}}" method="POST">
        @csrf
        @method("DELETE")
        <input type="submit" class="btn btn-danger" value="excluir">
    </form>
    <a href="/products/suppliers/edit/{{$supplier->id}}" class="btn btn-info">Editar</a>
    <hr class="border border-primary border-2 opacity-50">
@endforeach

<a class="btn btn-primary" href="/products/suppliers/create">Adicionar fornecedor</a>
@endsection