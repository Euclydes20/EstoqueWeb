@extends('adminlte::page')

@section('title', config('adminlte.title'))
<meta name="csrf_token" content="{{ csrf_token() }}" />

@section('content_header')
<span style="font-size:20px">
    <i class='fa fa-database'></i> Lista de Usuários
</span>

<ol class="breadcrumb">
    <li>
        <a href="{{ route('home') }}">Dashboard</a>
    </li>
    <li class="active">Lista de Usuários</li>
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

        <!-- somente administradores podem cadastrar usuários -->
        @if(Auth::user()->level == "Administrador")
        <div class="btn-group pull-right">
            <a class="btn btn-success btn-sm" href="{{ route('users.create') }}">
                <i class="fa fa-plus"></i> Inserir um novo registro
            </a>
        </div>
        @endif

        <h5>Relação de Usuários do Sistema</h5>
    </div>

    <div class="panel-body">
        <!-- Table -->
        <table class="table table-striped table-bordered table-hover table-responsive" id="table-usuarios">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome do Usuário</th>
                    <th>E-mail</th>
                    <th>Tipo de Usuário</th>
                    <th class='text-center'>Data de Criação</th>
                    <th class='text-center'>Ações</th>
                </tr>
            </thead>

            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>
                        {{ $user->id }}
                    </td>

                    <td>
                        {{ $user->name }}
                    </td>

                    <td>
                        {{ $user->email }}
                    </td>

                    <td>
                        {{ $user->level }}
                    </td>

                    <td class='text-center' style='width:150px'>
                        {{ $user->created_at->format('d/m/Y h:m') }}
                    </td>

                    <td style="width:135px;">
                        <!-- visualização de dados-->
                        <a class='btn btn-primary btn-sm' style="float:left; margin-right: 2px;"
                           href='{{ route("users.show", $user->id) }}' role='button'>
                            <i class='fa fa-eye'></i>
                        </a>

                        <!-- somente administradores podem editar e/ou excluir usuários -->
                        @if(Auth::user()->level == "Administrador")
                            <!-- edição de dados -->
                            <a class='btn btn-warning btn-sm'  style="float:left;margin-right: 2px;"
                            href='{{ route("users.edit", $user->id) }}' role='button'>
                                <i class='fa fa-pencil'></i>
                            </a>

                            <!-- o usuário não pode se excluir -->
                            @if (Auth::user()->id != $user->id)
                            <!-- exclusão do registro -->
                            <form action="{{ route('users.destroy', $user->id) }}" method="post">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <button type='submit' class='btn btn-danger btn-sm'  style="float:left">
                                    <i class='fa fa-trash'></i>
                                </button>
                            </form>
                            @endif
                        @endif
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>

    <div class="panel-footer">
        {{ $users->links()  }}
    </div>

</div>
@stop

@section('js')
<script>
$(document).ready(function() {
    $('#table-usuarios').DataTable(
        {
            "paging": false,
            "info": false,
            "searching": false,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
            },
            "processing": true,
        }
    );
});
</script>
@stop
