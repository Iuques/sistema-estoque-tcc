@extends('layouts.main')
@section('title', 'Cadastrar cliente')
@section('content')


<div class="col-md-6 offset-md-3" id="client-create-container">
    <h1>Cadastrar clientes</h1>
    <form action="/clients/store" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nome:</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Nome do cliente" required>
        </div>
        <div class="form-group">
            <label for="surname">Sobrenome:</label>
            <input type="text" id="surname" name="surname" class="form-control" placeholder="Sobrenome do cliente" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="emaildocliente@email.com" required>
        </div>
        <div class="form-group">
            <label for="telephone">Telefone:</label>
            <input type="tel" id="telephone" name="telephone" class="form-control" maxlength="15" required placeholder="(XX) 9XXXX-XXXX" pattern="\([0-9]{2}\) [9]{1}[0-9]{4}-[0-9]{4}" onkeyup="handlePhone(event)"/> 
        </div>
        <input type="submit" class="btn btn-primary" value="criar cliente">
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
