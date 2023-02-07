@extends('layouts.main')
@section('title', 'Usuários')
@section('content')
<h1>Lista usuários</h1>

@foreach ($users as $user)
    <p>Nome: {{ $user->name }} {{ $user->surname }}</p>
    <p>Email: {{ $user->email }}</p>
    <p>
        Tipo:
        @if ($user->type == 1)
            Admnistrador
        @else
            Comum
        @endif
    </p>
    <p>
        Vendas: 
        @if (count($user->sale()->get()) > 0)
            @foreach ($user->sale()->get() as $key => $sale)
                ID:{{$sale->id}}@if (count($user->sale()->get()) != $key+1),@endif
            @endforeach
        @else
            Este usuário ainda não realizou nenhuma venda.
        @endif
    </p>
    @if ($user->id != auth()->user()->id && auth()->user()->type == 1)
        <form action="/users/destroy/{{$user->id}}" method="POST">
            @csrf
            @method("DELETE")
            <input type="submit" class="btn btn-danger" value="excluir">
        </form>
    @endif
    @if (auth()->user()->type == 1)
        <a href="/users/edit/{{$user->id}}" class="btn btn-info">Editar</a>
    @endif
    <hr class="border border-primary border-2 opacity-50">
@endforeach

<a class="btn btn-primary" href="/users/create">Cadastrar usuário</a>
@endsection
