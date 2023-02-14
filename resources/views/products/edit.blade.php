@extends('layouts.main')
@section('title', 'Editar produto')
@section('content')

@php
    if ($product->image_id != null) {
        $image = $product->image()->first();
    }
@endphp

<div class="col-md-6 offset-md-3" id="product-edit-container">
    <div class="text-center">
        <h1>Editando produto: {{$product->name}}</h1>
    </div>
    <form action="/products/update/{{$product->id}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name"><b>Nome:</b></label>
            <input type="text" id="name" name="name" class="form-control" value="{{$product->name}}">
        </div>
        <br>
        <div class="form-group">
            <label for="description"><b>Descrição:</b></label>
            <textarea name="description" id="description" class="form-control" placeholder="Descrição do produto" rows="3" required>{{$product->description}}</textarea>
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
                            <input type="number" id="buyprice" name="buyprice" class="form-control" step="0.01" value="{{$product->buyprice}}" aria-label="buyprice" aria-describedby="buyprice" required>
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
                            <input type="number" id="sellprice" name="sellprice" class="form-control" step="0.01" value="{{$product->sellprice}}" aria-label="sellprice" aria-describedby="sellprice" required>
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
                        <input type="number" id="quantity" name="quantity" class="form-control text-center" value="{{$product->quantity}}" required>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="form-group">
            <label for="departament_id"><b>Departamento:</b></label>
            <select id="departament" name="departament_id" class="form-control" >
                <option value="">Selecione um departamento</option>
                @foreach ($departaments as $departament)
                    <option value="{{ $departament->id }}" @if($product->departament_id == $departament->id) selected @endif>
                        {{ $departament->name }} 
                    </option>
                @endforeach
            </select>
        </div>
        <br>
        <div class="form-group">
            <label for="supplier_id"><b>Fornecedor:</b></label>
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
            <div class="mb-3">
                <div class="row g-2 align-items-center">
                    <div class="col-md-10">
                        <label for="image" class="form-label"><b>Imagem:</b></label>
                    <input class="form-control" type="file" id="image" name="image_id">
                    </div>
                    <div class="col-md-2" >
                        Imagem atual:
                        @if ($product->image_id != null)
                            <img src="{{URL::asset("img/products/$image->url")}}" style="width: 90px;">
                        @else
                            Nenhuma
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="form-group text-center">
            <input type="submit" class="btn btn-primary btn-lg" value="Editar" style="width: 200px">
        </div>
    </form>
</div>
<div class="back">
    <a class="btn btn-danger btn-sm" href="/products"><i class='bx bx-arrow-back'></i> Voltar</a>
</div>

@endsection