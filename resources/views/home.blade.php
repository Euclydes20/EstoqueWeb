@extends('adminlte::page')

@section('title', config('adminlte.title'))

@section('content_header')

@if (session('message'))
    <div class="alert alert-{{ session('type') }} alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Atenção: </strong>{{ session('message') }}
    </div>
@endif

    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="row">
        @widget('widget_produtos')
        @widget('widget_fornecedores')
        @widget('widget_classificacoes')
    </div>
    <div class="row">
        @widget('widget_estoque_minimo')
    </div>
@stop
