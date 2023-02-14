@extends('layouts.main')
@section('title', 'Dashboard')
@section('content')
@php
    $loggedUser = Auth::User();
    if ($lastProducts != null) {
        foreach ($lastProducts as $lastProduct) {
            if ($lastProduct->image_id != null) {
                $image = $lastProduct->image()->first();
                $imageURL[$lastProduct->id] = $image->url;
            }
        }
    }
    if ($lastSale != null) { 
        $buyer = $lastSale->client()->first();
        $seller = $lastSale->user()->first();
    }
@endphp
<div class="col-md-6 offset-md-3" id="title">
    <h1>Seja bem vindo ao sistema Easy Management Stock</h1>
    <h2>Logado como <b>{{$loggedUser->name}}</b></h2> 
</div>
<div class="container my-4" style="width: 80%">
    <div class="text-center"> 
        <h2>Últimas inserções</h2>
    </div>
    @if (count($lastProducts) > 2)
        <div class="row justify-content-evenly my-3">
            @foreach ($lastProducts->take(3) as $lastProduct)
                <div class="card col mx-5 px-0" style="width: 300px;">
                    <div class="card-header text-bg-primary ">
                        <b>[ID:{{$lastProduct->id}}]</b> Produto
                    </div>
                    @if ($lastProduct->image_id)
                        <img src="../img/products/{{$imageURL[$lastProduct->id]}}" class="card-img-top" style="width: 342px; height: 342px;">
                    @else 
                        <img src="../img/products/produto-sem-imagem.png" class="card-img-top" alt="Sem imagem">
                    @endif
                    
                    <div class="card-body">
                        <h5 class="card-title"><b>{{$lastProduct->name}}</b></h5>
                        <p class="card-text">{{$lastProduct->description}}</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><b>Preço de compra:</b> R${{ number_format($lastProduct->buyprice,2) }}</li>
                        <li class="list-group-item"><b>Preço de venda:</b> R${{ number_format($lastProduct->sellprice,2) }}</li>
                        <li class="list-group-item"><b>Quantidade:</b> {{$lastProduct->quantity}}</li>
                    </ul>
                    <div class="card-footer text-muted">
                        Inserido em {{date( 'd/m/Y H:i' , strtotime($lastProduct->created_at))}}
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="row justify-content-evenly my-3">
            @for ($i = 0; $i < 3; $i++)
                <div class="card col mx-5 px-0" style="width: 300px;">
                    <div class="card-header text-bg-primary ">
                        <b>[ID: ..]</b> Produto
                    </div>
                    <img src="../img/products/produto-sem-imagem.png" class="card-img-top" alt="Sem imagem">
                    <div class="card-body">
                        <h5 class="card-title"><b>...</b></h5>
                        <p class="card-text">...</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><b>Preço de compra:</b> R$..</li>
                        <li class="list-group-item"><b>Preço de venda:</b> R$..</li>
                        <li class="list-group-item"><b>Quantidade:</b> ..</li>
                    </ul>
                    <div class="card-footer text-muted">
                        Inserido em ...
                    </div>
                </div>
            @endfor
        </div>
    @endif
    <div class="row my-5">
        <div class="col-sm-6 mb-3 mb-sm-0">
            @if ($lastSale != null)
                <div class="card">
                    <div class="card-header text-bg-primary ">
                        <b>[ID: {{$lastSale->id}}]</b> Venda
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"> Data da venda: {{date( 'd/m/Y' , strtotime($lastSale->selldate))}}</h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><b>Comprador:</b> {{ $buyer->name }} {{ $buyer->surname }}</li>
                        <li class="list-group-item"><b>Vendedor:</b> {{ $seller->name }} {{ $seller->surname }}</li>
                        <li class="list-group-item"><b>Valor:</b> R${{ number_format($lastSale->totalvalue,2) }}</li>
                    </ul>
                    <div class="card-footer text-muted">
                        Inserido em {{date( 'd/m/Y H:i' , strtotime($lastSale->created_at))}}
                    </div>
                </div>
            @else
                <div class="card">
                    <div class="card-header text-bg-primary ">
                        <b>[ID: ..]</b> Venda
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"> Data da venda: ...</h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><b>Comprador:</b> ...</li>
                        <li class="list-group-item"><b>Vendedor:</b> ...</li>
                        <li class="list-group-item"><b>Valor:</b> ...</li>
                    </ul>
                    <div class="card-footer text-muted">
                        Inserido em ...
                    </div>
                </div>
            @endif 
        </div>
        <div class="col-sm-6">
            @if ($lastClient != null)
                <div class="card">
                    <div class="card-header text-bg-primary ">
                        <b>[ID: {{$lastClient->id}}]</b> Cliente
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{$lastClient->name}} {{$lastClient->surname}}</h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><b>Email:</b> {{$lastClient->email}}</li>
                        <li class="list-group-item"><b>Telefone:</b> {{$lastClient->telephone}}</li>
                        <li class="list-group-item">
                            <b>Compras:</b> 
                            @if (count($lastClient->sale()->get()) > 0)
                                @foreach ($lastClient->sale()->get() as $key => $sale)
                                    {{$sale->id}}@if (count($lastClient->sale()->get()) != $key+1),@endif
                                @endforeach
                            @else
                                Este cliente ainda não realizou nenhuma compra.
                            @endif
                        </li>
                    </ul>
                    <div class="card-footer text-muted">
                        Inserido em {{date( 'd/m/Y H:i' , strtotime($lastClient->created_at))}}
                    </div>
                </div>
            @else
                <div class="card">
                    <div class="card-header text-bg-primary ">
                        <b>[ID: ..]</b> Cliente
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"> ...</h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><b>Comprador:</b> ...</li>
                        <li class="list-group-item"><b>Vendedor:</b> ...</li>
                        <li class="list-group-item"><b>Valor:</b> ...</li>
                    </ul>
                    <div class="card-footer text-muted">
                        Inserido em ...
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>


@endsection
