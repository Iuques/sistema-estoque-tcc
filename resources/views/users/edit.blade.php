@extends('layouts.main')
@section('title', 'Editar usuário')
@section('content')


<div class="col-md-6 offset-md-3" id="user-edit-container">
    <h1>Editar usuário</h1>
    <form action="/users/update/{{ $user->id }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nome:</label>
            <input type="text" id="name" name="name" class="form-control" value="{{$user->name}}">
        </div>
        <div class="form-group">
            <label for="surname">Sobrenome:</label>
            <input type="text" id="surname" name="surname" class="form-control" value="{{$user->surname}}">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="form-control" value="{{$user->email}}">
        </div>
        <div class="form-group">
            <label for="password">Senha:</label>
            <input type="password" id="password" name="password" class="form-control" value="{{$user->password}}" disabled>
        </div>
        <div class="form-group">
            <label for="type">Tipo:</label>
            <select id="type" name="type" class="form-control">
                <option value="1" @if($user->type === 1) selected @endif>Administrador</option>
                <option value="0" @if($user->type === 0) selected @endif>Comum</option>
            </select>
        </div>
        <input type="submit" class="btn btn-primary" value="editar usuario">
    </form>
</div>

<a class="btn btn-primary" href="/users">Voltar</a>
@endsection
