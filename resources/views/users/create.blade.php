@extends('adminlte::page')

@section('title', config('adminlte.title'))

@section('content_header')
<span style="font-size:20px">
    <i class='fa fa-database'></i> Cadastramento de Usuário</h1>
</span>

<ol class="breadcrumb">
    <li>
        <a href="{{ route('home') }}">Dashboard</a>
    </li>
    <li>
        <a href="{{ route('users.index') }}">Cadastramento</a>
    </li>
    <li class="active">Usuários</li>
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


<form action="{{ route('users.store') }}" method="post" role="form">
    {{ csrf_field() }}

    <div class="panel panel-default">
        <div class="panel-heading">
            Formulário de cadastramento de novo usuário
        </div> <!-- panel-heading -->

        <div class="panel-body">
            <!-- nome do usuário -->
            <div class="form-group">
                <label for="name">Nome do Usuário
                    <span class="text-red">*</span>
                </label>

                <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                    id="name" name="name" required>

                @if($errors->has('name'))
                <span class='invalid-feedback text-red'>
                    {{ $errors->first('name') }}
                </span>
                @endif
            </div>

            <!-- gender -->
            <div class="form-group">
                <label for="level">Gênero
                    <span class="text-red">*</span>
                </label>

                <select class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}" id="gender" name="gender" require>
                    <option value="N">Prefiro não responder</option>
                    <option value="M">Masculino</option>
                    <option value="F">Feminino</option>
                </select>

                @if($errors->has('gender'))
                <span class='invalid-feedback text-red'>
                    {{ $errors->first('gender') }}
                </span>
                @endif
            </div>

            <!-- email -->
            <div class="form-group">
                <label for="email">E-mail
                    <span class="text-red">*</span>
                </label>

                <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email" name="email" required>

                @if($errors->has('email'))
                <span class='invalid-feedback text-red'>
                    {{ $errors->first('email') }}
                </span>
                @endif
            </div>

            <!-- level -->
            <div class="form-group">
                <label for="level">Tipo de Usuário
                    <span class="text-red">*</span>
                </label>

                <select class="form-control {{ $errors->has('level') ? 'is-invalid' : '' }}" id="level" name="level" require>
                    <option value="Administrador">Administrador</option>
                    <option value="Usuário">Usuário</option>
                </select>

                @if($errors->has('level'))
                <span class='invalid-feedback text-red'>
                    {{ $errors->first('level') }}
                </span>
                @endif
            </div>

            <!-- password -->
            <div class="form-group">
                <label for="password">Senha</label>

                <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                    id="password" name="password" >

                @if($errors->has('password'))
                <span class='invalid-feedback text-red'>
                    {{ $errors->first('password') }}
                </span>
                @endif
            </div>
        </div> <!-- panel-body -->

        <div class="panel-footer">
            <a class="btn btn-default" href="{{ route('users.index') }}">
                <i class="fa fa-chevron-circle-left"></i> Voltar
            </a>

            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Atualizar</button>
        </div> <!-- panel-footer -->
    </div> <!-- panel-default -->
</form>
@stop
