@extends('layouts.products')
@section('title', 'Cadastrar departamento')
@section('content')


<div class="col-md-6 offset-md-3" id="departament-create-container">
    <div class="text-center">
        <h1>Cadastrar departamento</h1>
    </div>
    <form action="/products/departaments/store" method="POST">
        @csrf
        <div class="form-group">
            <label for="name"><b>Nome:</b></label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Nome do departamento" required>
        </div>
        <br>
        <div class="form-group">
            <label for="description"><b>Descrição:</b></label>
            <textarea name="description" id="description" class="form-control" placeholder="Descrição do departamento" rows="3" required></textarea>
        </div>
        <br>
        <div class="form-group text-center">
            <input type="submit" class="btn btn-primary btn-lg" value="Cadastrar" style="width: 200px">
        </div>
    </form>
</div>
<div class="back">
    <a class="btn btn-danger btn-sm" href="/products/departaments"><i class='bx bx-arrow-back'></i> Voltar</a>
</div>

@endsection
