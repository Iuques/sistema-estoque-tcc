@extends('layouts.main')
@section('title', 'Perfil')
@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
 
<div class="col-md-8 offset-md-2">
    <h1>Dados do usuário</h1>
    <p>Nome: {{$user->name}} {{$user->surname}}</p>
    <p>Email: {{$user->email}}</p>
    <p>Total de vendas: {{count($sales)}}</p>
    <p>
        Permissões:
        @if ($user->type == 1)
            Admnistrador, você possui todas as permissões
        @else
            Usuário, você não pode cadastrar, editar ou remover outros usuários
        @endif
    </p>
</div>
<br>
<div class="col-md-8 offset-md-2">
    <h2>Gráfico de vendas</h2>
    <canvas id="myChart"></canvas>
</div>
<script>
    const ctx = document.getElementById('myChart');
  
    new Chart(ctx, {
      type: 'line',
      data: {
        labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
        datasets: [{
          label: 'Vendas',
          data: {{ Js::from($monthSales) }}, 
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true,
            ticks: {
                precision: 0
            }
          }
        }
      }
    });
</script>
<br>
<div class="col-md-8 offset-md-2">
    <h2>Suas vendas</h2>
    @foreach ($sales as $sale)
        <p>ID: {{$sale->id}}</p>
        <p>Data: {{ date( 'd/m/Y' , strtotime($sale->selldate)) }}</p>
        <p>Valor total: R${{$sale->totalvalue}}</p>
        <p>Cliente: {{$sale->client()->value('name')}} {{$sale->client()->value('surname')}}</p>
        <hr>
    @endforeach
</div>
<br>
<div class="col-md-8  offset-md-2">
    <h2>Seus clientes</h2>
    @foreach ($clients as $client)
        <p>Nome: {{$client->name}} {{$client->surname}}</p>
        <p>Email: {{$client->email}}</p>
        <p>Telefone: {{$client->name}}</p>
        <p>
            Compras:
            @foreach ($client->sale()->get() as $key => $sale)
                ID:{{$sale->id}}@if (count($client->sale()->get()) != $key+1),@endif
            @endforeach
        </p>
        <hr>
    @endforeach
</div>
@endsection
