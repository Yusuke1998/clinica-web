@extends('layouts.dashboard')
@section('content')
<div class="bg-image overflow-hidden" style="background-image: url('{{ asset('website/img/logo.png') }}')!important;background-size: 300px 70px !important;background-position: center !important;background-repeat: no-repeat !important;">
    <div class="">
        <div class="content content-narrow content-full">
            
        </div>
    </div>
</div>
<div class="content content-narrow">
	<chart-component></chart-component>
</div>
@stop