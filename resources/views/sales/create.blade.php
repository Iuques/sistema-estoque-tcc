@extends('layouts.main')
@section('title', 'Realizar venda')
@section('content')


<div class="col-md-6 offset-md-3" id="sale-create-container">
    <h1>Realizar venda</h1>
    @if ($errors->all())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
                {{$error}}
            </div>
        @endforeach
    @endif
    <form action="/sales/store" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Atributos da venda -->
        <div class="form-group">
            <label for="selldate">Data da venda:</label>
            <input type="date" id="selldate" name="selldate" class="form-control">
        </div>
        <div class="form-group">
            <label for="client">Cliente comprador:</label>
            <select id="client" name="client" class="form-control" >
                <option value="">Selecione um cliente</option>
                @foreach ($clients as $client)
                    <option value="{{ $client->id }}">{{ $client->name }} {{ $client->surname }}</option>
                @endforeach
            </select>
            <input type="hidden" id="user" name="user" value="{{Auth::id()}}">
        </div>

        <!-- Atributos do produto -->
        <div id="sales_products_form">
            <hr>
            <div class="row" id="row1">
                <div class="form-group col-8">
                    <label for="product">Produto comprado:</label>
                    <select id="product" name="product1" class="form-control" >
                        <option value="">Selecione um produto</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-4">
                    <label for="quantity">Quantidade:</label>
                    <input type="number" id="quantity" name="quantity1" class="form-control" placeholder="0">
                </div>
                <input type="hidden" name="counter" value="1">
            </div>
        </div>
        <div class="form-group">
            <input type="button" class="btn btn-secondary" value="Adicionar outro produto +" onclick="addProductField()">
        </div>
        <!-- Enviar -->
        <input type="submit" class="btn btn-primary" value="ralizar venda">
    </form>
</div>

<a class="nav-link" href="/sales">Voltar</a>

<script>
    var counter = 1;
    function addProductField() {
        counter += 1;
        html = '<hr>\
        <div class="row" id="row'+counter+'">\
            <div class="form-group col-8">\
                <label for="product">Produto comprado:</label>\
                <select id="product" name="product'+counter+'" class="form-control" >\
                    <option value="">Selecione um produto</option>\
                    @foreach ($products as $product)\
                        <option value="{{ $product->id }}">{{ $product->name }} </option>\
                    @endforeach\
                </select>\
            </div>\
            <div class="form-group col-4">\
                <label for="quantity">Quantidade:</label>\
                <input type="number" id="quantity" name="quantity'+counter+'" class="form-control" placeholder="0">\
            </div>\
            <input type="hidden" name="counter" value="'+counter+'">\
        </div>';
        var form = document.getElementById('sales_products_form');
        form.innerHTML += html;
    }
</script>
@endsection
