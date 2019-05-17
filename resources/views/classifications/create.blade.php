@extends('adminlte::page')
@section('title', config('adminlte.title'))
@section('content_header')
<span style="font-size:20px">
    <i class='fa fa-database'></i> Inserindo um novo registro de Classificação</h1>
</span>

<ol class="breadcrumb">
    <li>
        <a href="{{ route('home') }}">Dashboard</a>
    </li>
    <li>
        <a href="{{ route('classifications.index') }}">Lista de Classificações</a>
    </li>
    <li class="active">Inserindo um novo registro</li>
</ol>

@stop
@section('content')

<form action="{{ route('classifications.store') }}" method="post" role="form">
    {{ csrf_field() }}

    <div class="panel panel-default">
        <div class="panel-heading">
            Formulário de inserção de registro
        </div> <!-- panel-heading -->

        <div class="panel-body">

            <div class="form-group">
                <label for="descricao">Descrição
                    <span class="text-red">*</span>
                </label>

                <input type="text" class="form-control {{ $errors->has('descricao') ? 'is-invalid' : '' }}"
                    id="descricao" name="descricao" placeholder="Descrição da classificação"
                    value="{{ old('descricao') }}">

                @if($errors->has('descricao'))
                <span class='invalid-feedback text-red'>
                    {{ $errors->first('descricao') }}
                </span>
                @endif
            </div>
        </div> <!-- panel-body -->

        <div class="panel-footer">
            <a class="btn btn-default" href="{{ route('classifications.index') }}">
                <i class="fa fa-chevron-circle-left"></i> Voltar
            </a>

            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Gravar</button>
        </div> <!-- panel-footer -->
    </div> <!-- panel-default -->
</form>

@stop
