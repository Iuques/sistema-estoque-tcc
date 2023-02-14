@extends('layouts.products')
@section('title', 'Editar departamento')
@section('content')


<div class="col-md-6 offset-md-3" id="departament-edit-container">
    <div class="text-center">
        <h1>Editando departamento: {{$departament->name}}</h1>
    </div>
    <form action="/products/departaments/update/{{$departament->id}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name"><b>Nome:</b></label>
            <input type="text" id="name" name="name" class="form-control" value="{{$departament->name}}">
        </div>
        <br>
        <div class="form-group">
            <label for="description"><b>Descrição:</b></label>
            <textarea name="description" id="description" class="form-control" placeholder="Descrição do departamento" rows="3">{{$departament->description}}</textarea>
        </div>
        <br>
        <div class="form-group text-center">
            <input type="submit" class="btn btn-primary btn-lg" value="Editar" style="width: 200px">
        </div>
    </form>
</div>
<div class="back">
    <a class="btn btn-danger btn-sm" href="/products/departaments"><i class='bx bx-arrow-back'></i> Voltar</a>
</div>

@endsection
