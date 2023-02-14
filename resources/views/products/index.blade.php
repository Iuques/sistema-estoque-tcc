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

<div class="row mb-3">
    <div class="col">
        @if ($search)
            <h1>Buscando por: {{$search}}</h1>
        @else
            <h1>Todos os produtos</h1>
        @endif
    </div>
    <div class="col" style="text-align: right">
        <a class="btn btn-primary btn-lg" href="/products/create">Cadastrar novo produto</a>
    </div>
</div>

@foreach ($products as $key => $product)
    <div class="row" id="product-row">
        <div class="card sm mx-auto" style="width: 90%;">
            <div class="row g-0">
                <div class="col">
                    @if ($product->image_id)
                        <img src="../img/products/{{ $imageURL[$product->id]}}" class="img-fluid rounded-start" alt="{{ $imageURL[$product->id]}}">
                    @else 
                        <img src="../img/products/produto-sem-imagem.png" class="img-fluid rounded-start" alt="Produto sem imagem">
                    @endif
                </div>
                <div class="col-md-10">
                    <div class="row" style="height: 100%">
                        <div class="col-auto d-flex align-items-center text-start">
                            <b>ID:</b>&nbsp;{{$product->id}}
                        </div>
                        <div class="col-4 d-flex align-items-center">
                            <b>Nome:</b>&nbsp; {{$product->name}}
                        </div>
                        <div class="col-6 d-flex align-items-center">
                            <form action="/products/update/{{$product->id}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row g-3 align-items-center">
                                    <div class="col-auto">
                                        <label for="inputPassword6" class="col-form-label"><b>Quantidade em estoque:</b></label>
                                    </div>
                                    <div class="col-auto">
                                        <input type="number" name="quantity" class="form-control text-center" value="{{$product->quantity}}" style="width: 60px">
                                    </div>
                                    <div class="col-auto">
                                    <span id="passwordHelpInline" class="form-text">
                                        <abbr title="Atualizar"><button type="submit" class="btn btn-primary"><i class='bx bx-upload' ></i></button></abbr>
                                    </span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-auto d-flex align-items-center" id="row-buttons">
                    <form action="/products/destroy/{{$product->id}}" method="POST">
                        <abbr title="Editar"><a href="/products/edit/{{$product->id}}" class="btn btn-info"><i class='bx bxs-edit'></i></a></abbr>
                        @csrf
                        @method("DELETE")
                        <abbr title="Excluir"><button type="submit" class="btn btn-danger"><i class='bx bx-trash' ></i></button></abbr>
                     </form> 
                </div>
                <div class="col-auto d-flex align-items-center text-end" id="collapse-button">
                    <abbr title="Abrir"><a class="btn" data-bs-toggle="collapse" href="#multiCollapseExample{{$key}}" role="button" aria-expanded="false" aria-controls="multiCollapseExample{{$key}}"><i class='bx bxs-chevrons-down'></i></a></abbr>
                </div>
            </div>
        </div>
    </div>
    <div class="row" id="product-details">
        <div class="card sm mx-auto" style="width: 90%; margin-bottom: 25px">
            <div class="col">
                <div class="collapse multi-collapse" id="multiCollapseExample{{$key}}">
                    <div class="card-body">
                        <p class="card-text">{{$product->description}}</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><b>Departamento:</b> {{ $departamentName[$product->id] }}</li>
                        <li class="list-group-item"><b>Fornecedor:</b> {{ $supplierName[$product->id] }}</li>
                        <li class="list-group-item"><b>Preço de compra:</b> R${{ number_format($product->buyprice,2) }}</li>
                        <li class="list-group-item"><b>Preço de venda:</b> R${{ number_format($product->sellprice,2) }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endforeach

@if (count($products) == 0 && $search)
    <p>Não foi possível encontrar nenhum produto com '{{$search}}' <a href="/products">Ver todos os produtos</a> </p> 
@elseif (count($products) == 0)
    <p>Nenhum produto foi adicionado</p>
@endif

@endsection