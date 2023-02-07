@extends('layouts.main')
@section('title', 'Vendas')
@section('content')
@php
    $clientName = [];
    $userName = [];
    foreach ($sales as $sale) {
        $client = $sale->client()->first();
        $clientName[$sale->id] = $client->name . " " . $client->surname;

        $user = $sale->user()->first();
        $userName[$sale->id] = $user->name . " " . $user->surname;
    } 
@endphp
<h1>Histórico de vendas</h1>
@foreach ($sales as $sale)
    <p>Id: {{ $sale->id }}</p>
    <p>Data: {{ date( 'd/m/Y' , strtotime($sale->selldate)) }}</p>
    <p>Valor: R${{ $sale->totalvalue }}</p>
    <p>Cliente: {{ $clientName[$sale->id] }}</p>
    <p>Vendedor: {{ $userName[$sale->id] }}</p>
    <form action="/sales/destroy/{{$sale->id}}" method="POST">
        @csrf
        @method("DELETE")
        <input type="submit" class="btn btn-danger" value="excluir">
    </form>
    <a href="/sales/receipt/{{$sale->id}}" class="btn btn-primary"> Gerar comprovante </a>
    
    <hr class="border border-primary border-2 opacity-50">
@endforeach

<a class="btn btn-primary" href="/sales/create">Realizar venda</a>
@endsection