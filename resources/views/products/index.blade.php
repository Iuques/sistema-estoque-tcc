@extends('layouts.products')
@section('title', 'Produtos')
@section('content')

@php
    $imageURL = [];
    $departamentName = [];
    $supplierName = [];
    foreach ($products as $product) {
        if ($product->image_id != NULL) {
            $image = $product->image()->first();
            $imageURL[$product->id] = $image->url;
        }

        $departament = $product->departament()->first();
        $departamentName[$product->id] = $departament->name;
    
        $supplier = $product->supplier()->first();
        $supplierName[$product->id] = $supplier->name;
    } 
@endphp

<div id="search-container" class="col-md-12">
    <h2>Buscar produto</h2>
    <form action="/products" method="GET">
        <input type="text" id="search" name="search" class="form-control" placeholder="Buscar...">
        <!-- <h2>Filtrar</h2>
        Por departamentos: <br>
        @foreach ($departaments as $key => $departament)
            <input type="checkbox" id="departament-checkbox" name="filterDepartament{{$key}}" value="{{ $departament->id }}">
            <label for="departament{{$key}}"> {{ $departament->name }} </label><br>
        @endforeach
        Por fornecedores: <br>
        @foreach ($suppliers as $key => $supplier)
            <input type="checkbox" id="supplier-checkbox" name="filterSupplier{{$key}}" value="{{ $supplier->id }}">
            <label for="supplier{{$key}}"> {{ $supplier->name }} </label><br>
        @endforeach -->
    </form>
</div>

<br>

@if ($search)
    <h1>Buscando por: {{$search}}</h1>
@else
    <h1>Todos os produtos</h1>
@endif


@foreach ($products as $product)
    <p id="product-image">
        Imagem do produto: 
        @if ($product->image_id)
            <img src="../img/products/{{ $imageURL[$product->id]}}" alt="{{ $imageURL[$product->id]}}">
            
        @else 
            <img src="../img/products/produto-sem-imagem.png" alt="Sem Imagem">
        @endif
    </p>
    <p>Nome: {{ $product->name }}</p>
    <p>Descrição: {{ $product->description }}</p>
    <p>Departamento: {{ $departamentName[$product->id] }}</p>
    <p>Fornecedor: {{ $supplierName[$product->id]}}</p>
    <p>Preço de compra: R${{ $product->buyprice }}</p>
    <p>Preço de venda: R${{ $product->sellprice }}</p>
    <p>
        <div class="input-group text-center mb-3" style="width: 130px">
            <form action="/products/update/{{$product->id}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <label for="quantity">Quantidade em estoque:</label> 
                <input type="number" name="quantity" class="form-control text-center" value="{{ $product->quantity }}">
                <input type="submit" class="input-group btn btn-primary" value="Atualizar">
            </form>
        </div>
    </p>
    <form action="/products/destroy/{{$product->id}}" method="POST">
        @csrf
        @method("DELETE")
        <input type="submit" class="btn btn-danger" value="excluir">
    </form>
    <a href="/products/edit/{{$product->id}}" class="btn btn-info">Editar</a>
    <hr class="border border-primary border-2 opacity-50">
@endforeach
@if (count($products) == 0 && $search)
    <p>Não foi possível encontrar nenhum produto com '{{$search}}' <a href="/products">Ver todos os produtos</a> </p> 
@elseif (count($products) == 0)
    <p>Nenhum produto foi adicionado</p>
@endif

<a class="btn btn-primary" href="/products/create">Adicionar produto</a>

<script> 
    

</script>
@endsection