@extends('adminlte::page')

@section('title', config('adminlte.title'))

@section('content_header')
<h1>
    <i class='fa fa-database'></i> Exibindo os detalhes do Fornecedor
</h1>

<ol class="breadcrumb">
    <li>
        <a href="{{ route('home') }}">Dashboard</a>
    </li>

    <li>
        <a href="{{ route('classifications.index') }}">Lista de Fornecedores</a>
    </li>

    <li class="active">Exibindo dados</li>
</ol>


@stop

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">
        <span>
            <a class='' href='{{ route('providers.index') }}'><i class='fa fa-chevron-circle-left'></i> Retorna
                para a tela de consulta</a>
        </span>
    </div>

    <div class="panel-body">
        <table class="table table-hover table-striped">
            <tbody>
                <tr>
                    <td class='col-sm-3'>ID</td>
                    <td class='col-sm-9'>{{ $provider->id }}</td>
                </tr>

                <tr>
                    <td class='col-sm-3'>Nome do Fornecedor</td>
                    <td class='col-sm-9'>{{ $provider->nome }}</td>
                </tr>

                <tr>
                    <td class='col-sm-3'>Data de Criação</td>
                    <td class='col-sm-9'>
                        @if (null != $provider->created_at)
                            {{ $provider->created_at->format('d/m/Y H:i') }}
                        @endif
                    </td>
                </tr>

                <tr>
                    <td class='col-sm-3'>Data da Última Atualização</td>
                    <td class='col-sm-9'>
                        @if (null != $provider->updated_at)
                            {{ $provider->updated_at->format('d/m/Y H:i') }}
                        @endif
                    </td>
                </tr>

            </tbody>
        </table>
    </div>

    <div class="panel-footer">
        <span>
            <a class='' href='{{ route('classifications.index') }}'><i class='fa fa-chevron-circle-left'></i> Retorna
                para a tela de consulta</a>
        </span>
    </div>
</div>


@stop
