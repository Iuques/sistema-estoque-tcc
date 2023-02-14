@extends('layouts.main')
@section('title', 'Editar usuário')
@section('content')


<div class="col-md-6 offset-md-3" id="user-edit-container">
    <div class="text-center">
        <h1>Editando usuário: {{$user->name}} {{$user->surname}}</h1>
    </div>
    <form action="/users/update/{{ $user->id }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name"><b>Nome:</b></label>
            <input type="text" id="name" name="name" class="form-control" value="{{$user->name}}">
        </div>
        <br>
        <div class="form-group">
            <label for="surname"><b>Sobrenome:</b></label>
            <input type="text" id="surname" name="surname" class="form-control" value="{{$user->surname}}">
        </div>
        <br>
        <div class="form-group">
            <label for="email"><b>Email:</b></label>
            <input type="email" id="email" name="email" class="form-control" value="{{$user->email}}">
        </div>
        <br>
        <div class="form-group">
            <label for="password"><b>Senha:</b></label>
            <input type="password" id="password" name="password" class="form-control" value="{{$user->password}}" disabled>
        </div>
        <br>
        <div class="form-group">
            <label for="type"><b>Tipo:</b></label>
            <select id="type" name="type" class="form-control">
                <option value="1" @if($user->type === 1) selected @endif>Administrador</option>
                <option value="0" @if($user->type === 0) selected @endif>Comum</option>
            </select>
        </div>
        <br>
        <div class="form-group text-center">
            <input type="submit" class="btn btn-primary btn-lg" value="Editar" style="width: 200px">
        </div>
    </form>
</div>
<div class="back">
    <a class="btn btn-danger btn-sm" href="/users"><i class='bx bx-arrow-back'></i> Voltar</a>
</div>
@endsection
