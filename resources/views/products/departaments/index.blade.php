@extends('layouts.products')
@section('title', 'Departamentos')
@section('content')

<div class="row">
    <div class="col">
        <h1>Lista de departamentos</h1>
    </div>
    <div class="col" style="text-align: right">
        <a class="btn btn-primary btn-lg" href="/products/departaments/create">Cadastrar novo departamento</a>
    </div>
</div>

@if (count($departaments) == 0)
    <p>Nenhum departamento foi adicionado</p>
@else
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nome</th>
            <th scope="col">Descrição</th>
            <th scope="col">Ações</th>
        </tr>
        </thead>
        <tbody class="table-group-divider">
            @foreach ($departaments as $departament)
                <tr>
                    <th scope="row">{{ $departament->id }}</th>
                    <td>{{ $departament->name }}</td>
                    <td>{{ $departament->description }}</td>
                    <td>
                        <form action="/products/departaments/destroy/{{$departament->id}}" method="POST">
                            <abbr title="Editar"><a href="/products/departaments/edit/{{$departament->id}}" class="btn btn-info"><i class='bx bxs-edit'></i></a></abbr>
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