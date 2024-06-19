@php

if(Request::is('events')) {
    $background = 'detail_page';
} else if(Request::is('venue')) {
    $background = 'venue_page';
} else if(Request::is('contact')) {
    $background = 'contact_page';
} else if(Request::is('about')) {
    $background = 'about_page';
} else {
    $background = 'detail_page';
}

@endphp

<div id="banner" class="{{$background}}">
        <header class="bg-transparent pt-3">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        {{-- <nav class="navbar navbar-expand-lg navbar-light bg-transparent ">
                            <a class="navbar-brand" href="{{route('frontend.index')}}">
                                LOGO
                            </a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav mr-auto">
                                    
                                        <li class="nav-item active">
                                                <a class="nav-link" href="{{route('frontend.events.index')}}">Events</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="venues.html">Venue</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#">About</a>
                                                </li>
                
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#">FAQ</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#">Testimonials</a>
                                                </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="blogs.html">BLOG</a>
                                    </li>
                                </ul>
                                <ul class="navbar-nav mr-0">
                                    <li class="nav-item active">
                                        <a class="nav-link" href="signIn.html">LOG IN</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="signup.html">REGISTER</a>
                                    </li>
                                </ul>
                            </div>
                        </nav> --}}
                        @include('frontend.includes.partials.menu')
                    </div>
                </div>
            </div>
            
        </header>
        
        <div class="search_banner">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="banner-inner">
                          
                            {{-- <form class="search_form">
                                <div class="form-row">

                                    <div class="col-sm-4">
                                        <label for="event_type">Event Type</label>
                                        <select class="form-control input-lg" id="event_type">
                                            <option selected>Choose...</option>
                                            <option value="1">Options</option>
                                            <option value="2">Options</option>
                                            <option value="3">Options</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="age_group">Age Group</label>
                                        <select class="form-control input-lg" id="age_group">
                                            <option selected>Choose...</option>
                                            <option value="1">Options</option>
                                            <option value="2">Options</option>
                                            <option value="3">Options</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="d-block" for="datepicker">Choose Date</label>
                                        <div class="d-flex">
                                            <input id="datepicker" type="text" class="form-control input-lg mr-2"
                                                placeholder="Date Start">

                                            <input id="datepicker_2" type="text" class="form-control input-lg"
                                                placeholder="Date End">
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group mt-3">
                                    <input type="text" class="form-control w-75 ml-auto mr-auto input-lg" placeholder="Type For Search Now">
                                </div>
                                <div class="text-center">
                                    <button type="button" class="btn btn-theme mt-2 btn-lg">Find Events Now</button>
                                </div>
                            </form> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>