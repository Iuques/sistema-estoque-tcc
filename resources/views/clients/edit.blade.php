@extends('layouts.main')
@section('title', 'Editar cliente')
@section('content')


<div class="col-md-6 offset-md-3" id="client-edit-container">
    <h1>Editar cliente</h1>
    <form action="/clients/update/{{$client->id}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nome:</label>
            <input type="text" id="name" name="name" class="form-control" value="{{$client->name}}">
        </div>
        <div class="form-group">
            <label for="surname">Sobrenome:</label>
            <input type="text" id="surname" name="surname" class="form-control" value="{{$client->surname}}">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="form-control" value="{{$client->email}}">
        </div>
        <div class="form-group">
            <label for="telephone">Telefone:</label>
            <input type="tel" id="telephone" name="telephone" class="form-control" maxlength="15" value="{{$client->telephone}}" pattern="\([0-9]{2}\) [9]{1}[0-9]{4}-[0-9]{4}" onkeyup="handlePhone(event)"/> 
        </div>
        <input type="submit" class="btn btn-primary" value="editar cliente">
    </form>
</div>

<a class="nav-link" href="/clients">Voltar</a>

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
