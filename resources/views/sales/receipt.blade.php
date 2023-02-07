@php
$client = $sale->client()->first();
$user = $sale->user()->first();
@endphp 

<h2>Comprovante de venda</h2>

ID da venda: {{$sale->id}} <br>
Data da venda: {{date( 'd/m/Y' , strtotime($sale->selldate))}} <br>
Cliente: {{ $client->name }} {{ $client->surname }} (ID:{{$client->id}})<br>
Vendedor: {{ $user->name }} {{ $user->surname }} (ID:{{$user->id}})<br>
<br>
@foreach ($products = $sale->products()->get() as $key => $product)
    <br>
    Produto {{$key+1}} (ID:{{$product->id}}): {{$product->name}}
    / Quantidade: {{$product->pivot->quantity}}
    / Valor individual: R${{$product->sellprice}}
    / Valor somado: R${{$product->pivot->value}}
    <hr>
@endforeach
<br>
Valor total: R${{$sale->totalvalue}}