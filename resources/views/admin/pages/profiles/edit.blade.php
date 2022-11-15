@extends('adminlte::page')

@section('title', "Editar o perfil: {$profile->name}")

@section('content_header')
    <h1>Editar o plano {{ $profile->name }}</h1>

@stop

@section('content')

    <div class="card">
        <div class="car-body">
            <form action="{{ route('profiles.update', ['profile' => $profile->id]) }}" method="POST"
                class="form">
                @csrf
                @method('PUT')
                @include('admin.pages.profiles._partials.form')
            </form>
        </div>
    </div>
@stop
