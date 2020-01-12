@extends('layouts.website')
@section('content')
<section class="custom-pt">
    <div class="container div-pt">
        <div style='max-width:800px;margin:20px auto'>

            @if (config("contactetc.show_errors_above_form",true) && isset($errors) && count($errors))
                <div class="alert alert-danger">
                    <b>Disculpa, pero ha ocurrido un error:</b>
                    <ul class='m-0'>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            {{--WARNING! THIS ECHOS OUT WHATEVER IS IN THE FORM CONFIG FILE, WITHOUT ESCAPING !--}}
            {!! $contactFormDetails->html_above_form ?? "" !!}

            <form method='post' action='{{$formUrl}}' class='contactetc_form '>

                @csrf

                @foreach($fields as $field)
                    <div class='contactetc_field contactetc_error'>
                        @includeFirst([$field->getView(),"contactetc::fields.default"])
                    </div>
                @endforeach


                <div class='contactetc_submit'>
                    <input type='submit' class='{{$contactFormDetails->submit_button_css_classes ?? 'btn btn-primary'}}'
                           value='{{$contactFormDetails->submit_button_text ?? "Send!"}}'>
                </div>

            </form>

            {{--WARNING! THIS ECHOS OUT WHATEVER IS IN THE FORM CONFIG FILE, WITHOUT ESCAPING !--}}
            {!! $contactFormDetails->html_below_form ?? "" !!}
        </div>
    </div>
</section>
@stop