@extends('adminlte::page')

@section('title', config('adminlte.title'))

@section('content_header')
<h1>
    <i class='fa fa-database'></i> Exibindo os detalhes do Produto
</h1>

<ol class="breadcrumb">
    <li>
        <a href="{{ route('home') }}">Dashboard</a>
    </li>

    <li>
        <a href="{{ route('classifications.index') }}">Lista de Produtos</a>
    </li>

    <li class="active">Exibindo dados</li>
</ol>


@stop

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">
        <span>
            <a class='' href='{{ route("products.index") }}'><i class='fa fa-chevron-circle-left'></i> Retorna
                para a tela de consulta</a>
        </span>
    </div>

    <div class="panel-body">
        <table class="table table-hover table-striped">
            <tbody>
                <tr>
                    <td class='col-sm-3'>ID</td>
                    <td class='col-sm-9'>{{ $product->id }}</td>
                </tr>

                <tr>
                    <td class='col-sm-3'>Nome do Produto</td>
                    <td class='col-sm-9'>{{ $product->descricao }}</td>
                </tr>


                <tr>
                    <td class='col-sm-3'>Qtd em Estoque</td>
                    <td class='col-sm-9'>{{ number_format($product->qtd, 0, '', '.') }}</td>
                </tr>

                <tr>
                    <td class='col-sm-3'>Estoque Minimo</td>
                    <td class='col-sm-9'>{{ number_format($product->estoque_minimo, 0, '', '.') }}</td>
                </tr>

                <tr>
                    <td class='col-sm-3'>Preço Venda</td>
                    <td class='col-sm-9'>R$ {{ number_format($product->prc_venda, 2, ',', '.') }}</td>
                </tr>

                <tr>
                    <td class='col-sm-3'>Preço Compra</td>
                    <td class='col-sm-9'>R$ {{ number_format($product->prc_compra, 2, ',', '.') }}</td>
                </tr>

                <tr>
                    <td class='col-sm-3'>Fornecedor</td>
                    <td class='col-sm-9'>{{ $product->provider_id }} - {{ $product->provider->nome }}</td>
                </tr>

                <tr>
                    <td class='col-sm-3'>Classificação</td>
                    <td class='col-sm-9'>{{ $product->classification_id }} - {{ $product->classification->descricao }}</td>
                </tr>

                <tr>
                    <td class='col-sm-3'>Data de Criação</td>
                    <td class='col-sm-9'>
                        @if (null != $product->created_at)
                            {{ $product->created_at->format('d/m/Y H:i') }}
                        @endif
                    </td>
                </tr>

                <tr>
                    <td class='col-sm-3'>Data da Última Atualização</td>
                    <td class='col-sm-9'>
                        @if (null != $product->updated_at)
                            {{ $product->updated_at->format('d/m/Y H:i') }}
                        @endif
                    </td>
                </tr>

            </tbody>
        </table>
    </div>

    <div class="panel-footer">
        <span>
            <a class='' href='{{ route("products.index") }}'><i class='fa fa-chevron-circle-left'></i> Retorna
                para a tela de consulta</a>
        </span>
    </div>
</div>


@stop
