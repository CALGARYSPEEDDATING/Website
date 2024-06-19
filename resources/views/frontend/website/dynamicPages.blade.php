@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('{{ $dynamicPages->page_slug }}'))

@section('content')

    <section class="events_listing_home main_padding">
        <div class="container">
            <div class="row">
                <div class="container-contact100-form-btn">
                    <div class="wrap-contact100-form-btn">
                        <a href="{{route('frontend.auth.register')}}" class="contact100-form-btn btn btn-theme">
                            Register
                        </a>
                    </div>
                </div>
            </div>
            <hr>
            @if ($dynamicPages)
                <div class="row">
                    <h1 class="text-dark title-main"> {{ $dynamicPages->page_title }} </h1>
                </div>
                <div class="row">
                    <div class="col-12">
                        {!!$dynamicPages->description!!}
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="container-contact100-form-btn">
                        <div class="wrap-contact100-form-btn">
                            <a href="{{route('frontend.auth.register')}}" class="contact100-form-btn btn btn-theme">
                                Register
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>





@endsection
