@extends('layouts.main')
@section('title', 'Perfil')
@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
 
<div class="col-md-8 offset-md-2">
    <div class="row">
        <div class="col-md-4">
            <h2>Dados do usuário</h2>
            <br>
            <p><b>Nome:</b> {{$user->name}} {{$user->surname}}</p>
            <p><b>Email:</b> {{$user->email}}</p>
            <p><b>Total de vendas:</b> {{count($sales)}}</p>
            <p>
                <b>Permissões de</b> 
                @if ($user->type == 1)
                    <b>Admnistrador</b>, você pode:
                    <p>Cadastrar, editar e remover usuários;</p>
                    <p>Cadastrar, editar e remover clientes;</p>
                    <p>Cadastrar, editar e remover produtos;</p>
                    <p>Realizar e deletar vendas.</p>
                @else
                    <b>Usuário</b>, você pode:
                    <p>Cadastrar, editar e remover clientes;</p>
                    <p>Cadastrar, editar e remover produtos;</p>
                    <p>Realizar vendas.</p>
                @endif
            </p>
        </div>
        <div class="col-md-8">
                <h2>Gráfico de vendas</h2>
                <canvas id="myChart"></canvas>
        </div>
    </div>
</div>
<br>
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

<div class="col-md-8 offset-md-2">
    <div class="row g-2">
        <div class="col-md-6">
            <h2>Suas vendas <a class="btn btn-primary" data-bs-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Mostrar</a></h2>
            <div class="collapse multi-collapse" id="multiCollapseExample1">
                @if (count($sales) == 0)
                    <p>Você ainda não realizou nenhum venda</p>
                @else
                    @foreach ($sales as $sale)
                        <p><b>ID:</b> {{$sale->id}}</p>
                        <p><b>Data:</b> {{ date( 'd/m/Y' , strtotime($sale->selldate)) }}</p>
                        <p><b>Valor total:</b> R${{ number_format($sale->totalvalue,2) }}</p>
                        <p><b>Cliente:</b> {{$sale->client()->value('name')}} {{$sale->client()->value('surname')}}</p>
                        <hr>
                    @endforeach
                @endif
            </div> 
        </div>
        <div class="col-md-6">
            <h2>Seus clientes <a class="btn btn-primary" data-bs-toggle="collapse" href="#multiCollapseExample2" role="button" aria-expanded="false" aria-controls="multiCollapseExample2">Mostrar</a></h2>
            <div class="collapse multi-collapse" id="multiCollapseExample2">
                @if (count($clients) == 0)
                    <p>Você ainda não tem nenhum cliente</p>
                @else
                    @foreach ($clients as $client)
                        <p><b>Nome:</b> {{$client->name}} {{$client->surname}}</p>
                        <p><b>Email:</b> {{$client->email}}</p>
                        <p><b>Telefone:</b> {{$client->telephone}}</p>
                        <p>
                            <b>Compras:</b>
                            @foreach ($client->sale()->get() as $key => $sale)
                                @foreach ($sales as $uSale)
                                    @if ($sale->id == $uSale->id)
                                        <b>ID:</b>{{$sale->id}}@if (count($client->sale()->get()) != $key+1),@endif
                                    @endif
                                @endforeach
                            @endforeach
                        </p>
                        <hr>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
