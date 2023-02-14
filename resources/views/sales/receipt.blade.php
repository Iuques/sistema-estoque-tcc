<head>
    <style>
        * {
            background-color: beige;
            margin: 0;
            padding: 0;
        }
        .container {
            margin: 20px 0 20px 10px;
        }
        h1 {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
    @php
    $client = $sale->client()->first();
    $user = $sale->user()->first();
    @endphp 

    <h1>Comprovante de Venda</h1>

    <b>ID da venda:</b> {{$sale->id}} <br>
    <b>Data da venda:</b> {{date( 'd/m/Y' , strtotime($sale->selldate))}} <br>
    <b>Cliente</b>: {{ $client->name }} {{ $client->surname }} <b>[ID:{{$client->id}}]</b><br>
    <b>Vendedor:</b> {{ $user->name }} {{ $user->surname }} <b>[ID:{{$user->id}}]</b><br>

    <br>
    <b>========================================////==============================================</b>
    <br>

    @foreach ($products = $sale->products()->get() as $key => $product)
        <br>
        <b>Produto {{$key+1}}:</b> {{$product->name}}
        // <b>Quantidade:</b> {{$product->pivot->quantity}}
        // <b>Valor individual:</b> R${{ number_format($product->sellprice,2,',') }}
        // <b>Valor somado:</b> R${{ number_format($product->pivot->value,2,',') }}
        <hr>
    @endforeach

    <br>
    <b>========================================////==============================================</b>
    <br>

    <br>
    <b>Valor total:</b> R${{ number_format($sale->totalvalue,2,',') }}
    </div>
</body>