@extends('adminlte::page')

@section('title', config('adminlte.title'))

@section('content_header')
<span style="font-size:20px">
    <i class='fa fa-database'></i> Alteração de dados de Classificação</h1>
</span>

<ol class="breadcrumb">
    <li>
        <a href="{{ route('home') }}">Dashboard</a>
    </li>
    <li>
        <a href="{{ route('classifications.index') }}">Lista de Classificações</a>
    </li>
    <li class="active">Alteração de dados</li>
</ol>

@stop
@section('content')

<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">Formulário de alteração de dados</div>
    <div class="panel-body">

        <form action="{{ route('classifications.update', $classification->id) }}" method="post" role="form">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="PUT">

            <div class="form-group">

                <label for="descricao">Descrição
                    <span class="text-red">*</span>
                </label>

                <input type="text" class="form-control {{ $errors->has('descricao') ? 'is-invalid' : '' }}"
                    id="descricao" name="descricao" placeholder="Descrição da classificação"
                    value="{{ $classification->descricao }}">

                @if($errors->has('descricao'))
                <span class='invalid-feedback text-red'>
                    {{ $errors->first('descricao') }}
                </span>
                @endif

            </div>

            <a class="btn btn-default" href="{{ route('classifications.index') }}">
                <i class="fa fa-chevron-circle-left"></i> Voltar
            </a>

            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Atualizar</button>

        </form>

    </div>
</div>
@stop
