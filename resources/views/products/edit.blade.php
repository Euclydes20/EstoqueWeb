@extends('adminlte::page')

@section('title', config('adminlte.title'))

@section('content_header')
<span style="font-size:20px">
    <i class='fa fa-database'></i> Alteração de dados do Produto</h1>
</span>

<ol class="breadcrumb">
    <li>
        <a href="{{ route('home') }}">Dashboard</a>
    </li>
    <li>
        <a href="{{ route('products.index') }}">Lista de Produtos</a>
    </li>
    <li class="active">Alteração de dados</li>
</ol>

@stop
@section('content')

<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">Formulário de alteração de dados</div>
    <div class="panel-body">

        <form action="{{ route('products.update', $product->id) }}" method="post" role="form">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="PUT">

            <!-- descrição do produto -->
            <div class="form-group">

                <label for="descricao">Descrição do Produto
                    <span class="text-red">*</span>
                </label>

                <input type="text" class="form-control {{ $errors->has('descricao') ? 'is-invalid' : '' }}"
                    id="descricao" name="descricao" placeholder="Forneça a descrição do produto"
                    value="{{ $product->descricao }}">

                @if($errors->has('descricao'))
                <span class='invalid-feedback text-red'>
                    {{ $errors->first('descricao') }}
                </span>
                @endif

            </div>

            <!-- quantidade -->
            <div class="form-group">

                <label for="qtd">Quantidade em estoque
                    <span class="text-red">*</span>
                </label>

                <input type="number" class="form-control {{ $errors->has('qtd') ? 'is-invalid' : '' }}"
                    id="qtd" name="qtd" min=0 max=99999
                    value="{{ $product->qtd }}">

                @if($errors->has('qtd'))
                <span class='invalid-feedback text-red'>
                    {{ $errors->first('qtd') }}
                </span>
                @endif

            </div>


            <!-- preço de venda -->
            <div class="form-group">

                <label for="prc_venda">Preço de Venda
                    <span class="text-red">*</span>
                </label>

                <div class="input-group">
                    <div class="input-group-addon">R$</div>
                    <input type="number" class="form-control {{ $errors->has('prc_venda') ? 'is-invalid' : '' }}"
                        id="prc_venda" name="prc_venda" min="0.00" max="99999.99" step="0.01"
                        value="{{ $product->prc_venda }}">

                    @if($errors->has('prc_venda'))
                    <span class='invalid-feedback text-red'>
                        {{ $errors->first('prc_venda') }}
                    </span>
                    @endif

                </div>

            </div>

            <!-- preço de compra -->
            <div class="form-group">

                <label for="prc_compra">Preço de Compra
                    <span class="text-red">*</span>
                </label>

                <div class="input-group">
                    <div class="input-group-addon">R$</div>
                    <input type="number" class="form-control {{ $errors->has('prc_compra') ? 'is-invalid' : '' }}"
                        id="prc_compra" name="prc_compra" min="0.00" max="99999.99" step="0.01"
                        value="{{ $product->prc_compra }}">

                    @if($errors->has('prc_compra'))
                    <span class='invalid-feedback text-red'>
                        {{ $errors->first('prc_compra') }}
                    </span>
                    @endif

                </div>

            </div>

            <!-- fornecedor -->
            <div class="form-group">

                <label for="provider_id">Fornecedor
                    <span class="text-red">*</span>
                </label>

                <div class="input-group">
                    <select name="provider_id" class="form-control">
                        <?php
                            $providers = DB::table('providers')
                                ->select("id", "nome")
                                ->orderBy("nome", "asc")
                                ->get();

                            foreach ($providers as $p) {
                                $selected="";
                                if ($p->id == $product->provider_id) {
                                    $selected= "selected";
                                }

                                echo "<option value=$p->id $selected>$p->nome</option>";
                            }
                        ?>
                    </select>

                    @if($errors->has('provider'))
                    <span class='invalid-feedback text-red'>
                        {{ $errors->first('provider') }}
                    </span>
                    @endif
                </div>

            </div>

            <!-- classificação -->
            <div class="form-group">

                <label for="classification_id">Classificação
                    <span class="text-red">*</span>
                </label>

                <div class="input-group">
                    <select name="classification_id" class="form-control">
                        <?php
                            $classifications = DB::table('classifications')
                                ->select("id", "descricao")
                                ->orderBy("descricao", "asc")
                                ->get();

                            foreach ($classifications as $c) {
                                $selected="";
                                if ($c->id == $product->classification_id) {
                                    $selected= "selected";
                                }

                                echo "<option value=$c->id $selected>$c->descricao</option>";
                            }
                        ?>
                    </select>

                    @if($errors->has('classification'))
                    <span class='invalid-feedback text-red'>
                        {{ $errors->first('classification') }}
                    </span>
                    @endif
                </div>

            </div>






            <a class="btn btn-default" href="{{ route('products.index') }}">
                <i class="fa fa-chevron-circle-left"></i> Voltar
            </a>

            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Atualizar</button>

        </form>

    </div>
</div>
@stop
