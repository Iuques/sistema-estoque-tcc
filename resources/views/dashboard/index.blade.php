@extends('layouts.main')
@section('title', 'Dashboard')
@section('content')
@php
    $loggedUser = Auth::User();
@endphp
<div class="col-md-6 offset-md-3" id="title">
    <h1>Dashboard</h1>
    <p>Seja bem vindo ao sistema Easy Management Stock</p>
    <p>Logado como <b>{{$loggedUser->name}}</b></p> 
    <div class="row"> 
        <hr>
        <p class="text-center">
            Ultimo produto inserido: 
            @if ($lastProduct != null)
                {{$lastProduct->name}}, ID: {{$lastProduct->id}}, Data: {{date( 'd/m/Y' , strtotime($lastProduct->created_at))}}
            @else
                Nenhum.
            @endif
        </p>
    </div>
    <div class="row"> 
        <hr>
        <p class="text-center">
            Ultima venda realizada:
            @if ($lastSale != null)
                ID: {{$lastSale->id}}, Data: {{date( 'd/m/Y' , strtotime($lastSale->created_at))}}
            @else
                Nenhuma.
            @endif 
        </p>
    </div>
    <div class="row">
        <hr> 
        <p class="text-center">
            Ultimo cliente cadastrado:
            @if ($lastClient != null)
                {{$lastClient->name}}, ID: {{$lastClient->id}}, Data: {{date( 'd/m/Y' , strtotime($lastClient->created_at))}}
            @else
                Nenhum.
            @endif
        </p>
    </div>
    <img src="img/banner-emstock.jpg" alt="Banner EMStock">
</div>


@endsection
