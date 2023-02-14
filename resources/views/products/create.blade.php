@extends('layouts.main')
@section('title', 'Cadastrar produto')
@section('content')


<div class="col-md-6 offset-md-3" id="product-create-container">
    <div class="text-center">
        <h1>Cadastrar produto</h1>
    </div>
    <form action="/products/store" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name"><b>Nome:</b></label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Nome do produto" required>
        </div>
        <br>
        <div class="form-group">
            <label for="description"><b>Descrição:</b></label>
            <textarea name="description" id="description" class="form-control" placeholder="Descrição do produto" rows="3" required></textarea>
        </div>
        <br>
        <div class="row g-3 align-items-center">
            <div class="col-md-4">
                <div class="row g-2 align-items-center">
                    <div class="col-auto">
                        <label for="buyprice"><b>Preço de compra:</b></label>
                    </div>
                    <div class="col-md-5">
                        <div class="input-group">
                            <span class="input-group-text" id="buyprice">R$</span>
                            <input type="number" id="buyprice" name="buyprice" class="form-control" step="0.01" placeholder="00.00" aria-label="buyprice" aria-describedby="buyprice" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="row g-2 align-items-center">
                    <div class="col-auto">
                        <label for="sellprice"><b>Preço de venda:</b></label>
                    </div>
                    <div class="col-md-5">
                        <div class="input-group">
                            <span class="input-group-text" id="sellprice">R$</span>
                            <input type="number" id="sellprice" name="sellprice" class="form-control" step="0.01" placeholder="00.00" aria-label="sellprice" aria-describedby="sellprice" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="row g-2 align-items-center">
                    <div class="col-auto">
                        <label for="quantity"><b>Quantidade:</b></label>
                    </div>
                    <div class="col-md-2">
                        <input type="number" id="quantity" name="quantity" class="form-control text-center" placeholder="0" required>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="form-group">
            <label for="departament"><b>Departamento:</b></label>
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
                <label for="depName"><b>Nome do departamento:</b></label>
                <input type="text" id="depName" name="depName" class="form-control" placeholder="Nome do departamento">
            </div>
            <br>
            <div class="form-group">
                <label for="depDesc"><b>Descrição do departamento:</b></label>
                <textarea id="depDesc" name="depDesc" class="form-control" placeholder="Descrição do departamento" rows="2"></textarea>
            </div>
            <hr>
        </div>
        <br>
        <div class="form-group">
            <label for="supplier"><b>Fornecedor:</b></label>
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
                <label for="supName"><b>Nome do fornecedor:</b></label>
                <input type="text" id="supName" name="supName" class="form-control" placeholder="Nome do fornecedor">
            </div>
            <br>
            <div class="form-group">
                <label for="supContact"><b>Contato do fornecedor:</b></label>
                <input type="text" id="supContact" name="supContact" class="form-control" placeholder="Contato do fornecedor">
            </div>
            <br>
            <div class="form-group">
                <label for="supAddress"><b>Endereço do fornecedor:</b></label>
                <input type="text" id="supAddress" name="supAddress" class="form-control" placeholder="Endereço do fornecedor">
            </div>
            <hr>
        </div>
        <br>
        <div class="form-group">
            <div class="mb-3">
                <label for="image" class="form-label"><b>Imagem:</b></label>
                <input class="form-control" type="file" id="image" name="image">
            </div>
        </div>
        <br>
        <div class="form-group text-center">
            <input type="submit" class="btn btn-primary btn-lg" value="Cadastrar" style="width: 200px">
        </div>
    </form>
</div>
<div class="back">
    <a class="btn btn-danger btn-sm" href="/products"><i class='bx bx-arrow-back'></i> Voltar</a>
</div>

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
