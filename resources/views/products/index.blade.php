@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Lista de Produtos</h1>
    @if (session('sucesso'))
        <div class="alert alert-success alert-dismissible mt-2">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> Sucesso!</h5>
            {{ session('sucesso') }}
        </div>
    @endif
@endsection

@section('content')
    <div class="box box-info" id="box-collapse">
        <div class="box-body">
            <div class="row" style="margin-bottom: 0px;">
                <div class="form-group col-1">
                    <a href="{{route('products.create')}}"><button type="button" class="btn btn-block btn-primary">Novo</button></a>
                </div>
                <div class="form-group col-md-12">
                    <table id="tabela" class="table table-bordered table-hover" style="width:100%; font-size: 13px;">
                        <thead>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Valor</th>
                            <th>Usuário</th>
                            <th>Categoria</th>
                            <th>Editar</th>
                            <th>Excluir</th>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->value }}</td>
                                    <td>{{ $product->user->name }}</td>
                                    <td>{{ $product->category->name }}</td>
                                    <td>
                                        <a href="{{ route('products.edit', $product->id) }}">
                                            <i class="fas fa-user-edit"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <a href="#" onclick="this.parentNode.submit();">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@endsection

@section('js')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $('#tabela').DataTable({
                destroy: true,
                order: [0, 'desc'],
                dom: 'Bfrtp',
                pageLength: 10,
            });
        });
    </script>
@endsection
