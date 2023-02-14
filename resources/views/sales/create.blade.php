@extends('layouts.main')
@section('title', 'Realizar venda')
@section('content')


<div class="col-md-6 offset-md-3" id="sale-create-container">
    <div class="text-center">
        <h1>Realizar venda</h1>
    </div>
    <form action="/sales/store" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Atributos da venda -->
        <div class="form-group">
            <label for="selldate"><b>Data da venda:</b></label>
            <input type="date" id="selldate" name="selldate" class="form-control" required>
        </div>
        <br>
        <div class="form-group">
            <label for="client"><b>Cliente comprador:</b></label>
            <select id="client" name="client" class="form-control" required>
                <option disabled selected>Selecione um cliente</option>
                @foreach ($clients as $client)
                    <option value="{{ $client->id }}">{{ $client->name }} {{ $client->surname }}</option>
                @endforeach
            </select>
            <input type="hidden" id="user" name="user" value="{{Auth::id()}}">
        </div>
        <br>

        <!-- Atributos do produto -->
        <div class="form-group">
            <button type="button" class="btn btn-secondary" onclick="addProductField()"><i class='bx bx-add-to-queue'></i> Adicionar produto</button> 
        </div>
        <div id="sales_products_form">
            <hr>
            <div class="row" id="row1">
                <div class="form-group col-8">
                    <label for="product"><b>Produto comprado:</b></label>
                    <select id="product" name="product1" class="form-select" required>
                        <option disabled selected>Selecione um produto</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-4">
                    <label for="quantity"><b>Quantidade:</b></label>
                    <input type="number" id="quantity" name="quantity1" class="form-control" placeholder="0" required>
                </div>
                <input type="hidden" name="counter" value="1">
            </div>
        </div>
        <br>
        <div class="form-group text-center">
            <input type="submit" class="btn btn-primary btn-lg" value="Concluir" style="width: 200px">
        </div>
    </form>
</div>
<div class="back">
    <a class="btn btn-danger btn-sm" href="/sales"><i class='bx bx-arrow-back'></i> Voltar</a>
</div>

<script>
    var counter = 1;
    function addProductField() {
        counter += 1;
        html = '<hr>\
        <div class="row" id="row'+counter+'">\
            <div class="form-group col-8">\
                <label for="product">Produto comprado:</label>\
                <select id="product" name="product'+counter+'" class="form-select" >\
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
