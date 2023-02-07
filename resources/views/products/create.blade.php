@extends('layouts.main')
@section('title', 'Cadastrar produto')
@section('content')


<div class="col-md-6 offset-md-3" id="product-create-container">
    <h1>Cadastrar produto</h1>
    <form action="/products/store" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Nome:</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Nome do produto" required>
        </div>
        <div class="form-group">
            <label for="description">Descrição:</label>
            <input type="textarea" id="description" name="description" class="form-control" placeholder="Descrição do produto" required>
        </div>
        <div class="form-group">
            <label for="buyprice">Preço de compra:</label>
            <input type="number" id="buyprice" name="buyprice" class="form-control" placeholder="00.00" required>
        </div>
        <div class="form-group">
            <label for="sellprice">Preço de venda:</label>
            <input type="number" id="sellprice" name="sellprice" class="form-control" placeholder="00.00" required>
        </div>
        <div class="form-group">
            <label for="quantity">Quantidade:</label>
            <input type="number" id="quantity" name="quantity" class="form-control" placeholder="0" required>
        </div>
        <div class="form-group">
            <label for="departament">Departamento:</label>
            <select id="departament" name="departament" onChange="newDepartament()" class="form-control" required>
                <option value="">Selecione um departamento</option>
                <option value="newDep">Criar novo departamento</option>
                @foreach ($departaments as $departament)
                    <option value="{{ $departament->id }}">{{ $departament->name }} </option>
                @endforeach
            </select>
        </div>
        <div id="displayDepartamentForm" style="display: none" > 
            <hr>
            <div class="form-group">
                <label for="depName">Nome do departamento:</label>
                <input type="text" id="depName" name="depName" class="form-control" placeholder="Nome do departamento">
            </div>
            <div class="form-group">
                <label for="depDesc">Descrição do departamento:</label>
                <input type="textarea" id="depDesc" name="depDesc" class="form-control" placeholder="Descrição do departamento">
            </div>
            <hr>
        </div>
        <div class="form-group">
            <label for="supplier">Fornecedor:</label>
            <select id="supplier" name="supplier" onChange="newSupplier()" class="form-control" required>
                <option value="">Selecione um fornecedor</option>
                <option value="newSup" >Cadastrar novo fornecedor</option>
                @foreach ($suppliers as $supplier)
                    <option value="{{ $supplier->id }}">{{ $supplier->name }} </option>
                @endforeach
            </select>
        </div>
        <div id="displaySupplierForm" style="display: none" > 
            <hr>
            <div class="form-group">
                <label for="supName">Nome do fornecedor:</label>
                <input type="text" id="supName" name="supName" class="form-control" placeholder="Nome do fornecedor">
            </div>
            <div class="form-group">
                <label for="supContact">Contato do fornecedor:</label>
                <input type="text" id="supContact" name="supContact" class="form-control" placeholder="Contato do fornecedor">
            </div>
            <div class="form-group">
                <label for="supAddress">Endereço do fornecedor:</label>
                <input type="text" id="supAddress" name="supAddress" class="form-control" placeholder="Endereço do fornecedor">
            </div>
            <hr>
        </div>
        <br>
        <div class="form-group">
            <label for="image">Imagem:</label>
            <input type="file" id="image" name="image" class="form-control-file">
        </div>
        <br>
        <input type="submit" class="btn btn-primary" value="cadastrar produto">
    </form>
</div>

<a class="nav-link" href="/products">Voltar</a>

<script>
    function newDepartament() {
        var e = document.getElementById("departament");
        var depDiv = document.getElementById("displayDepartamentForm");
        for(var i = 0; i < e.options.length; i++) {
            if (e.options[i].selected && e.options[i].value === 'newDep') {
                depDiv.style.display = 'block';
            } else if (e.options[i].selected && e.options[i].value !== 'newDep') {
                depDiv.style.display = 'none';
            }
        }
    }
    function newSupplier() {
        var e = document.getElementById("supplier");
        var supDiv = document.getElementById("displaySupplierForm");
        for(var i = 0; i < e.options.length; i++) {
            if (e.options[i].selected && e.options[i].value === 'newSup') {
                supDiv.style.display = 'block';
            } else if (e.options[i].selected && e.options[i].value !== 'newSup') {
                supDiv.style.display = 'none';
            }
        }
    }
</script>
@endsection
