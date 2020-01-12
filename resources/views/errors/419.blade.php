@extends('errors::illustrated-layout')

@section('code', '419')
@section('title', __('Sesion Expirada'))

@section('image')
    <div style="background-image: url({{ asset('/svg/403.svg') }});" class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
    </div>
@endsection

@section('message', __('Disculpa, tu sesion ha expirado.'))
