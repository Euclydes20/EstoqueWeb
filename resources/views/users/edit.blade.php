@extends('adminlte::page')

@section('title', config('adminlte.title'))

@section('content_header')
<span style="font-size:20px">
    <i class='fa fa-database'></i> Alteração de dados do Usuário</h1>
</span>

<ol class="breadcrumb">
    <li>
        <a href="{{ route('home') }}">Dashboard</a>
    </li>
    <li>
        <a href="{{ route('users.index') }}">Alteração</a>
    </li>
    <li class="active">Dados do Usuário</li>
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


<form action="{{ route('users.update', $user->id) }}" method="post" role="form">
    {{ csrf_field() }}
    <input type="hidden" name="_method" value="PUT">

    <div class="panel panel-default">
        <div class="panel-heading">
            Formulário de alteração de dados
        </div> <!-- panel-heading -->

        <div class="panel-body">
            <!-- nome do usuário -->
            <div class="form-group">
                <label for="name">Nome do Usuário
                    <span class="text-red">*</span>
                </label>

                <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                    id="name" name="name" value="{{ $user->name }}" required>

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
                    <option value="N" {{ $user->gender == "N" ? "selected" : "" }}>Prefiro não responder</option>
                    <option value="M" {{ $user->gender == "M" ? "selected" : "" }}>Masculino</option>
                    <option value="F" {{ $user->gender == "F" ? "selected" : "" }}>Feminino</option>
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

                <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email" name="email" value="{{ $user->email }}" required>

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
                    <option value="Administrador" {{ $user->level == "Administrador" ? "selected" : "" }}>Administrador</option>
                    <option value="Usuário" {{ $user->level == "Usuário" ? "selected" : "" }}>Usuário</option>
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
                    id="password" name="password" placeholder="Deixe em branco para não alterar a senha">

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
