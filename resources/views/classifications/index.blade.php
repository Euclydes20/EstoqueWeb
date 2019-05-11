@extends('adminlte::page')

@section('title', config('adminlte.title'))
<meta name="csrf_token" content="{{ csrf_token() }}" />

@section('content_header')
<span style="font-size:20px">
    <i class='fa fa-database'></i> Lista de Classificações
</span>

<ol class="breadcrumb">
    <li>
        <a href="{{ route('home') }}">Dashboard</a>
    </li>
    <li class="active">Lista de Classificações</li>
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
            <a class="btn btn-success btn-sm" href="{{ route('classifications.create') }}">
                <i class="fa fa-plus"></i> Inserir um novo registro
            </a>
        </div>
        <h5>Relação de registros de Classificação</h5>
    </div>

    <div class="panel-body">
        <!-- Table -->
        <table class="table table-striped table-bordered table-hover table-responsive" id="table-classificacao">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Descrição</th>
                    <th class='text-center'>Data de Criação</th>
                    <th class='text-center'>Ações</th>
                </tr>
            </thead>

            <tbody>
                @foreach($classifications as $classification)
                <tr>
                    <td>
                        {{ $classification->id }}
                    </td>

                    <td>
                        {{ $classification->descricao }}
                    </td>

                    <td class='text-center' style='width:150px'>
                        {{ $classification->created_at->format('d/m/Y h:m') }}
                    </td>

                    <td style="width:135px;">
                        <!-- visualização de dados-->
                        <a class='btn btn-primary btn-sm' style="float:left; margin-right: 2px;"
                           href='{{ route("classifications.show", $classification->id) }}' role='button'>
                            <i class='fa fa-eye'></i>
                        </a>

                        <!-- edição de dados -->
                        <a class='btn btn-warning btn-sm'  style="float:left;margin-right: 2px;"
                           href='{{ route("classifications.edit", $classification->id) }}' role='button'>
                            <i class='fa fa-pencil'></i>
                        </a>

                        <!-- exclusão do registro -->
                        <form action="{{ route('classifications.destroy', $classification->id) }}" method="post">
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
        {{ $classifications->links()  }}
    </div>

</div>
@stop

@section('js')
<script>
$(document).ready(function() {
    $('#table-classificacao').DataTable(
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
