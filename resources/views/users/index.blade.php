@extends('layouts.main')
@section('title', 'Usuários')
@section('content')

<div class="row">
    <div class="col">
        <h1>Lista de usuários</h1>
    </div>
    <div class="col" style="text-align: right">
        <a class="btn btn-primary btn-lg" href="/users/create">Cadastrar novo usuário</a>
    </div>
</div>

<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Nome</th>
        <th scope="col">Email</th>
        <th scope="col">Tipo</th>
        <th scope="col">IDs das Vendas</th>
        @if (auth()->user()->type == 1)
            <th scope="col">Ações</th>
        @endif
      </tr>
    </thead>
    <tbody class="table-group-divider">
        @foreach ($users as $user)
            <tr>
                <th scope="row">{{ $user->id }}</th>
                <td>{{ $user->name }} {{ $user->surname }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @if ($user->type == 1)
                        Admnistrador
                    @else
                        Comum
                    @endif
                </td>
                <td>
                    @if (count($user->sale()->get()) > 0)
                        @foreach ($user->sale()->get() as $key => $sale)
                            {{$sale->id}}@if (count($user->sale()->get()) != $key+1),@endif
                        @endforeach
                    @else
                        Este usuário ainda não realizou nenhuma venda.
                    @endif
                </td>
                @if (auth()->user()->type == 1)
                    <td>
                        <form action="/users/destroy/{{$user->id}}" method="POST">
                            <abbr title="Editar"><a href="/users/edit/{{$user->id}}" class="btn btn-info"><i class='bx bxs-edit'></i></a></abbr>
                            @if ($user->id != auth()->user()->id)
                                @csrf
                                @method("DELETE")
                                <abbr title="Excluir"><button type="submit" class="btn btn-danger"><i class='bx bx-trash' ></i></button></abbr>
                            @endif
                        </form> 
                    </td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
