@extends('layouts.products')
@section('title', 'Fornecedores')
@section('content')

<div class="row">
    <div class="col">
        <h1>Lista de fornecedores</h1>
    </div>
    <div class="col" style="text-align: right">
        <a class="btn btn-primary btn-lg" href="/products/suppliers/create">Cadastrar novo fornecedor</a>
    </div>
</div>

@if (count($suppliers) == 0)
    <p>Nenhum fornecedor foi adicionado</p>
@else
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome</th>
                <th scope="col">Contato</th>
                <th scope="col">Endereço</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @foreach ($suppliers as $supplier)
                <tr>
                    <th scope="row">{{ $supplier->id }}</th>
                    <td>{{ $supplier->name }}</td>
                    <td>{{ $supplier->contact }}</td>
                    <td>{{ $supplier->address }}</td>
                    <td>
                        <form action="/products/suppliers/destroy/{{$supplier->id}}" method="POST">
                            <abbr title="Editar"><a href="/products/suppliers/edit/{{$supplier->id}}" class="btn btn-info"><i class='bx bxs-edit'></i></a></abbr>
                            @csrf
                            @method("DELETE")
                            <abbr title="Excluir"><button type="submit" class="btn btn-danger"><i class='bx bx-trash' ></i></button></abbr>
                        </form> 
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

@endsection