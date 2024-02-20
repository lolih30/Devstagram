<!-- directiva en blade -->
@extends('layouts.app')

@section('titulo')
    Página principal
@endsection

@section('contenido')
    <x-listar-post :posts="$posts">

    </x-listar-post>
@endsection
