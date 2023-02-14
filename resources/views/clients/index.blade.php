@extends('layouts.main')
@section('title', 'Clientes')
@section('content')

<div class="row">
    <div class="col">
        <h1>Lista clientes</h1>
    </div>
    <div class="col" style="text-align: right">
        <a class="btn btn-primary btn-lg" href="/clients/create">Cadastrar novo cliente</a>
    </div>
</div>

@if (count($clients) == 0)
    <p>Nenhum departamento foi adicionado</p>
@else
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nome</th>
            <th scope="col">Email</th>
            <th scope="col">Telefone</th>
            <th scope="col">IDs das Compras</th>
            <th scope="col">Ações</th>
        </tr>
        </thead>
        <tbody class="table-group-divider">
            @foreach ($clients as $client)
                <tr>
                    <th scope="row">{{ $client->id }}</th>
                    <td>{{ $client->name }} {{ $client->surname }}</td>
                    <td>{{ $client->email }}</td>
                    <td>{{ $client->telephone }}</td>
                    <td>
                        @if (count($client->sale()->get()) > 0)
                            @foreach ($client->sale()->get() as $key => $sale)
                                {{$sale->id}}@if (count($client->sale()->get()) != $key+1),@endif
                            @endforeach
                        @else
                            Este cliente ainda não realizou nenhuma compra.
                        @endif
                    </td>
                    <td>
                        <form action="/clients/destroy/{{$client->id}}" method="POST">
                            <abbr title="Editar"><a href="/clients/edit/{{$client->id}}" class="btn btn-info"><i class='bx bxs-edit'></i></a></abbr>
                            @csrf
                            @method("DELETE")
                            <abbr title="Excluir"><button type="submit" class="btn btn-danger"><i class='bx bx-trash'></i></button></abbr>
                        </form> 
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

@endsection
