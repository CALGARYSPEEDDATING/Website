@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.frontend.contact.box_title'))

@section('content')
<section id="blog_list" class="main_padding">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center mb-5 ">
                    <h2 class="p-0 mb-3 section-title">Venue</h2>
                    <p>Rodney's Oyster House Calgary</p>
                    <p>355 10 Ave SW, Calgary, AB T2R 0A5</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-5">
                    <a href="#"><img src="{{asset('frontend/images/venue/6Light.jpg')}}" alt="image"></a>
                </div>
                <div class="col-md-6 mb-5">
                    <img src="{{asset('frontend/images/venue/7DarkMatte.jpg')}}" alt="image">
                </div>
                
                <div class="col-md-6 mb-5">
                    <img src="{{asset('frontend/images/venue/10Light.jpg')}}" alt="image">
                </div>
                <div class="col-md-6 mb-5">
                    <img src="{{asset('frontend/images/venue/20DarkMatte.jpg')}}" alt="image">
                    
                </div>
                <div class="col-md-6 mb-5">
                    <img src="{{asset('frontend/images/venue/21LightMatte.jpg')}}" alt="image">
                </div>
                <div class="col-md-6 mb-5">
                    <img src="{{asset('frontend/images/venue/15Light.jpg')}}" alt="image">
                </div>
                <div class="col-md-6 mb-5">
                        <img src="{{asset('frontend/images/venue/12Light.jpg')}}" alt="image">
                    </div>
            </div>

        </div>
    </section>
    
    <section id="featured_events" class="pt-5 pb-5 bg-grey">
            @include('frontend.includes.featured') 
        </section>



@endsection