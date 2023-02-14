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

<div class="row">
    <div class="col">
        <h1>Histórico de vendas</h1>
    </div>
    <div class="col" style="text-align: right">
        <a class="btn btn-primary btn-lg" href="/sales/create">Realizar nova venda</a>
    </div>
</div>

@if (count($sales) == 0)
    <p>Nenhum departamento foi adicionado</p>
@else
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Data</th>
            <th scope="col">Cliente</th>
            <th scope="col">Vendedor</th>
            <th scope="col">Valor</th>
            <th scope="col">Ações</th>
        </tr>
        </thead>
        <tbody class="table-group-divider">
            @foreach ($sales as $sale)
                <tr>
                    <th scope="row">{{ $sale->id }}</th>
                    <td>{{ date( 'd/m/Y' , strtotime($sale->selldate)) }}</td>
                    <td>{{ $clientName[$sale->id] }}</td>
                    <td>{{ $userName[$sale->id] }}</td>
                    <td>R${{ number_format($sale->totalvalue,2,",") }}</td>
                    <td>
                        <form action="/sales/destroy/{{$sale->id}}" method="POST">
                            <abbr title="Gerar comprovante"><a href="/sales/receipt/{{$sale->id}}" class="btn btn-primary"><i class='bx bxs-receipt'></i></a></abbr>
                            @if (auth()->user()->type == 1)
                                @csrf
                                @method("DELETE")
                                <abbr title="Excluir"><button type="submit" class="btn btn-danger"><i class='bx bx-trash'></i></button></abbr>
                            @endif
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

@endsection