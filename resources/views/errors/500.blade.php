@extends('errors::illustrated-layout')

@section('code', '500')
@section('title', __('Error en el servidor'))

@section('image')
    <div style="background-image: url({{ asset('/svg/500.svg') }});" class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
    </div>
@endsection

@section('message', __('Wow, hay un error en el servidor, vuelve mas tarde.'))
