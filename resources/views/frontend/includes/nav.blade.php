<div id="banner">
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

                                
                                <!-- <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        INFO
                                    </a>
                                    <div class="dropdown-menu dropdown-menu1" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item text-uppercase" href="#">ABOUT SPEEDDATER</a>
                                        <a class="dropdown-item text-uppercase" href="#">Customer reviews</a>
                                        <a class="dropdown-item text-uppercase" href="#">What is speed dating</a>
                                        <a class="dropdown-item text-uppercase" href="#">What are singles parties</a>
                                        <a class="dropdown-item text-uppercase" href="#">Meet your hosts</a>
                                        <a class="dropdown-item text-uppercase" href="#">Dating tips</a>
                                        <a class="dropdown-item text-uppercase" href="faq.html">Faqs</a>
                                    </div>
                                </li> -->
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


    {{-- <img class="lozad" data-src="img.jpg"> --}}
    <div id="slider" class="carousel slide" data-ride="carousel">
            {{-- <div id="slider"> --}}
        <!-- The slideshow -->
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ URL::asset('frontend/images/banners/slider-image-1.jpg')}}"  alt="Calgary Speed Dating">               
            </div>
                         {{-- <img src="{{ URL::asset('frontend/images/banners/slider2.jpg')}}" alt="Dating Website"> --}}
            {{-- <div class="carousel-item">
   
                <img src="{{ URL::asset('frontend/images/banners/slider_img_1.jpg')}}" alt="Online Dating">
            </div>   --}}
            <!-- <div class="carousel-item">
                <img src="{{ URL::asset('frontend/images/banners/slider_img_2.jpg')}}" alt="Calgary Speed Dating">
            </div>  -->
        </div>
        <!-- Left and right controls -->
        <!-- <a class="carousel-control-prev" href="#slider" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#slider" data-slide="next">
            <span class="carousel-control-next-icon"></span>
        </a> -->
    </div>


    <div class="banner-text">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <section class="uk-singles js-uk-singles text-center">
                        <div class="uk-singles-info">
                            <h1 class="d-none d-lg-block mt-3  animated bounceInDown">Speed Dating in Calgary</h1>
                            <!-- <h4 class="d-none d-lg-block mt-3 animated bounceInDown ">More dating events, attendees &amp; matches than any company in Calgary</h4> -->
                            <h2 class="d-none d-lg-block mt-3 animated bounceInDown ">Our dating events have the highest turnout and create more meaningful connections than any other events in Calgary. Connect with 12 singles in a fun and relaxed environment at our monthly singles meetups. Book today!</h2>
                        <a href="{{route('frontend.events.index')}}" class="btn btn-theme mt-5 mt-10  animated bounceInDown">FIND EVENTS</a>
                        </div>
                        {{-- d-sm-none d-md-block  --}}
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>
