@extends('adminlte::page')

@section('title', "Detalhes do Perfil { $profiles->name }")

@section('content_header')
    <h1>Detalhes do plano{{ $profiles->name }}</h1>

@stop

@section('content')
    @include('admin.includes.alerts')
    <div class="card">
        <div class="car-body">
            <ul>
                <li>
                    <strong>Nome: </strong>{{ $profiles->name }}
                </li>
                <li>
                    <strong>Descrição: </strong>{{ $profiles->description }}
                </li>
            </ul>
        </div>

    </div>
    <form action="{{ route('profiles.destroy', ['profile' => $profiles->id]) }}" method="POST">
        @method('DELETE')
        @csrf
        <button type="submit" class="btn btn-danger">Deletar o {{ $profiles->name }}</button>
    </form>
@stop
