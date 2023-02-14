@extends('layouts.main')
@section('title', 'Editar cliente')
@section('content')


<div class="col-md-6 offset-md-3" id="client-edit-container">
    <div class="text-center">
        <h1>Editando cliente: {{$client->name}} {{$client->surname}}</h1>
    </div>
    <form action="/clients/update/{{$client->id}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name"><b>Nome:</b></label>
            <input type="text" id="name" name="name" class="form-control" value="{{$client->name}}">
        </div>
        <br>
        <div class="form-group">
            <label for="surname"><b>Sobrenome:</b></label>
            <input type="text" id="surname" name="surname" class="form-control" value="{{$client->surname}}">
        </div>
        <br>
        <div class="form-group">
            <label for="email"><b>Email:</b></label>
            <input type="email" id="email" name="email" class="form-control" value="{{$client->email}}">
        </div>
        <br>
        <div class="form-group">
            <label for="telephone"><b>Telefone:</b></label>
            <input type="tel" id="telephone" name="telephone" class="form-control" maxlength="15" value="{{$client->telephone}}" pattern="\([0-9]{2}\) [9]{1}[0-9]{4}-[0-9]{4}" onkeyup="handlePhone(event)"/> 
        </div>
        <br>
        <div class="form-group text-center">
            <input type="submit" class="btn btn-primary btn-lg" value="Editar" style="width: 200px">
        </div>
    </form>
</div>
<div class="back">
    <a class="btn btn-danger btn-sm" href="/clients"><i class='bx bx-arrow-back'></i> Voltar</a>
</div>

<script>
    const handlePhone = (event) => {
        let input = event.target
        input.value = phoneMask(input.value)
    }

    const phoneMask = (value) => {
        if (!value) return ""
        value = value.replace(/\D/g,'')
        value = value.replace(/(\d{2})(\d)/,"($1) $2")
        value = value.replace(/(\d)(\d{4})$/,"$1-$2")
        return value
    }
</script>
@endsection
