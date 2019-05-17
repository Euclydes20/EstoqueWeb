@extends('adminlte::page')

@section('title', config('adminlte.title'))

@section('content_header')
<h1>
    <i class='fa fa-database'></i> Exibindo os detalhes do usuário
</h1>

<ol class="breadcrumb">
    <li>
        <a href="{{ route('home') }}">Dashboard</a>
    </li>

    <li>
        <a href="{{ route('users.index') }}">Lista de Usuários</a>
    </li>

    <li class="active">Exibindo dados</li>
</ol>
@stop

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">
        <span>
            <a class='' href='{{ route('users.index') }}'><i class='fa fa-chevron-circle-left'></i> Retorna
                para a tela de consulta</a>
        </span>
    </div>

    <div class="panel-body">
        <table class="table table-hover table-striped">
            <tbody>
                <tr>
                    <td class='col-sm-3'>ID</td>
                    <td class='col-sm-9'>{{ $user->id }}</td>
                </tr>

                <tr>
                    <td class='col-sm-3'>Nome do Usuário</td>
                    <td class='col-sm-9'>{{ $user->name }}</td>
                </tr>

                <tr>
                    <td class="col-sm-3">Gênero</td>
                    <td class="col-sm-9">
                        @if($user->gender == "N") Preferiu não responder @endif
                        @if($user->gender == "M") Masculino @endif
                        @if($user->gender == "F") Feminino @endif
                    </td>
                </tr>

                <tr>
                    <td class='col-sm-3'>E-mail</td>
                    <td class='col-sm-9'>{{ $user->email }}</td>
                </tr>

                <tr>
                    <td class='col-sm-3'>Tipo de Usuário</td>
                    <td class='col-sm-9'>{{ $user->level }}</td>
                </tr>

                <tr>
                    <td class='col-sm-3'>Data de Criação</td>
                    <td class='col-sm-9'>
                        @if(null != $user->created_at)
                            {{ $user->created_at->format('d/m/Y H:i') }}
                        @endif
                    </td>
                </tr>

                <tr>
                    <td class='col-sm-3'>Data da Última Atualização</td>
                    <td class='col-sm-9'>
                        @if (null != $user->updated_at)
                            {{ $user->updated_at->format('d/m/Y H:i') }}
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="panel-footer">
        <span>
            <a class='' href='{{ route('users.index') }}'><i class='fa fa-chevron-circle-left'></i> Retorna
                para a tela de consulta</a>
        </span>
    </div>
</div>
@stop
