@extends('layouts.main')
@section('title', 'Clientes')
@section('content')
<h1>Lista clientes</h1>
@foreach ($clients as $client)
    <p>Nome: {{ $client->name }} {{ $client->surname }}</p>
    <p>Email: {{ $client->email }}</p>
    <p>Telefone: {{ $client->telephone }}</p>
    <p>
        Compras: 
        @if (count($client->sale()->get()) > 0)
            @foreach ($client->sale()->get() as $key => $sale)
                ID:{{$sale->id}}@if (count($client->sale()->get()) != $key+1),@endif
            @endforeach
        @else
            Este cliente ainda não realizou nenhuma compra.
        @endif
    </p>
    <form action="/clients/destroy/{{$client->id}}" method="POST">
        @csrf
        @method("DELETE")
        <input type="submit" class="btn btn-danger" value="excluir">
    </form>
    <a href="/clients/edit/{{$client->id}}" class="btn btn-info">Editar</a>
    <hr class="border border-primary border-2 opacity-50">
@endforeach

<a class="btn btn-primary" href="/clients/create">Cadastrar cliente</a>
@endsection
