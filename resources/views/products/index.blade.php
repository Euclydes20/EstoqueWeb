@extends('adminlte::page')

@section('title', config('adminlte.title'))
<meta name="csrf_token" content="{{ csrf_token() }}" />

@section('content_header')
<span style="font-size:20px">
    <i class='fa fa-database'></i> Lista de Produtos
</span>

<ol class="breadcrumb">
    <li>
        <a href="{{ route('home') }}">Dashboard</a>
    </li>
    <li class="active">Lista de Produtos</li>
</ol>

@stop

@section('content')

@if (session('message'))
    <div class="alert alert-{{ session('type') }} alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Atenção: </strong>{{ session('message') }}
    </div>
@endif

<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading clearfix">
        <div class="btn-group pull-right">
            <a class="btn btn-success btn-sm" href="{{ route('products.create') }}">
                <i class="fa fa-plus"></i> Inserir um novo registro
            </a>
        </div>
        <h5>Relação de Produtos</h5>
    </div>

    <div class="panel-body">
        <!-- Table -->
        <table class="table table-striped table-bordered table-hover table-responsive" id="table-produtos">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome do Produto</th>
                    <th>Qtd em Estoque</th>
                    <th>Preço Venda</th>
                    <th class='text-center'>Data de Criação</th>
                    <th class='text-center'>Ações</th>
                </tr>
            </thead>

            <tbody>
                @foreach($products as $p)
                <tr>
                    <td>
                        {{ $p->id }}
                    </td>

                    <td>
                        {{ str_limit($p->descricao,45) }}
                    </td>

                    <td class='text-right'>
                        {{ $p->qtd }}
                    </td>

                    <td class='text-right'>
                        {{ number_format($p->prc_venda, 2, ',', '.') }}
                    </td>

                    <td class='text-center' style='width:150px'>
                        {{ $p->created_at->format('d/m/Y H:i') }}
                    </td>

                    <td style="width:135px;">
                        <!-- visualização de dados-->
                        <a class='btn btn-primary btn-sm' style="float:left; margin-right: 2px;"
                           href='{{ route("products.show", $p->id) }}' role='button'>
                            <i class='fa fa-eye'></i>
                        </a>

                        <!-- edição de dados -->
                        <a class='btn btn-warning btn-sm'  style="float:left;margin-right: 2px;"
                           href='{{ route("products.edit", $p->id) }}' role='button'>
                            <i class='fa fa-pencil'></i>
                        </a>

                        <!-- exclusão do registro -->
                        <form action="{{ route('products.destroy', $p->id) }}" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_return" value="{{ Request::url() }}/?page={{  Request::get('page') }}">

                            <button type='submit' class='btn btn-danger btn-sm'  style="float:left">
                                <i class='fa fa-trash'></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>

    <div class="panel-footer">
        {{ $products->links()  }}
    </div>

</div>
@stop

@section('js')
<script>
$(document).ready(function() {
    $('#table-produtos').DataTable(
        {
            "paging": false,
            "info": false,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
            },
            "processing": true,
        }
    );
});
</script>

@stop
