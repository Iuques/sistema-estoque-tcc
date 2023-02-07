@extends('layouts.main')
@section('title', 'Editar produto')
@section('content')


<div class="col-md-6 offset-md-3" id="product-edit-container">
    <h1>Editar produto</h1>
    <form action="/products/update/{{$product->id}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nome:</label>
            <input type="text" id="name" name="name" class="form-control" value="{{$product->name}}">
        </div>
        <div class="form-group">
            <label for="description">Descrição:</label>
            <input type="textarea" id="description" name="description" class="form-control" value="{{$product->description}}">
        </div>
        <div class="form-group">
            <label for="buyprice">Preço de compra:</label>
            <input type="number" id="buyprice" name="buyprice" class="form-control" value="{{$product->buyprice}}">
        </div>
        <div class="form-group">
            <label for="sellprice">Preço de venda:</label>
            <input type="number" id="sellprice" name="sellprice" class="form-control" value="{{$product->sellprice}}">
        </div>
        <div class="form-group">
            <label for="quantity">Quantidade:</label>
            <input type="number" id="quantity" name="quantity" class="form-control" value="{{$product->quantity}}">
        </div>
        <div class="form-group">
            <label for="departament_id">Departamento:</label>
            <select id="departament" name="departament_id" class="form-control" >
                <option value="">Selecione um departamento</option>
                @foreach ($departaments as $departament)
                    <option value="{{ $departament->id }}" @if($product->departament_id == $departament->id) selected @endif>
                        {{ $departament->name }} 
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="supplier_id">Fornecedor:</label>
            <select id="supplier" name="supplier_id" class="form-control" >
                <option value="">Selecione um fornecedor</option>
                @foreach ($suppliers as $supplier)
                    <option value="{{ $supplier->id }}" @if($product->supplier_id == $supplier->id) selected @endif>
                        {{ $supplier->name }} 
                    </option>
                @endforeach
            </select>
        </div>
        <br>
        <div class="form-group">
            <label for="image_id">Imagem:</label>
            <input type="file" id="image" name="image_id" class="form-control-file">
            IMAGEM ATUAL: {{$product->image_id}}
        </div>
        <br>
        <input type="submit" class="btn btn-primary" value="editar produto">
    </form>
</div>

<a class="nav-link" href="/products">Voltar</a>

@endsection