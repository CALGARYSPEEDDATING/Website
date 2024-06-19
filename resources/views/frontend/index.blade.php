@extends('frontend.layouts.app')
@section('meta_description', 'Calgary Speed Dating is the #1 company for speed dating in Calgary. 💏 Meet Calgary singles through speed dating. Register now. 80% Match Rate')
@section('title', 'Calgary Speed Dating | #1 Company for Speed Dating')
@push('after-styles')
<style type="text/css">
    @keyframes lds-dual-ring {
        0% {
          -webkit-transform: rotate(0);
          transform: rotate(0);
        }
        100% {
          -webkit-transform: rotate(360deg);
          transform: rotate(360deg);
        }
      }
      @-webkit-keyframes lds-dual-ring {
        0% {
          -webkit-transform: rotate(0);
          transform: rotate(0);
        }
        100% {
          -webkit-transform: rotate(360deg);
          transform: rotate(360deg);
        }
      }
      .lds-dual-ring {
        position: relative;
      }
      .lds-dual-ring div {
        position: absolute;
        width: 160px;
        height: 160px;
        top: 20px;
        left: 20px;
        border-radius: 50%;
        border: 8px solid #000;
        border-color: #FF0000 transparent #FF0000 transparent;
        -webkit-animation: lds-dual-ring 1s linear infinite;
        animation: lds-dual-ring 1s linear infinite;
      }
      .lds-dual-ring {
        width: 100px !important;
        height: 100px !important;
        -webkit-transform: translate(-50px, -50px) scale(0.5) translate(50px, 50px);
        transform: translate(-50px, -50px) scale(0.5) translate(50px, 50px);
        margin: 0 auto;
      }
      </style>
      
@endpush
@section('title', app_name() . ' | ' . __('navs.general.home'))
  {{-- {{ asset('frontend/images/')}} --}}
@section('content')
{{-- transparent-missed-bitcoin hoge-banner.png
                <h3 class="hoge-text text-center d-none d-lg-block mt-3 animated bounceInDown">
                All events for 2021 sponsored by Hoge.
            </h3>
            <h3 class="d-md-block d-lg-none ">
                All events for 2021 sponsored by Hoge.
            </h3>
    --}}
        
        <!--  Sections -->
        <div id="services" class="pt-5 pb-4 text-center scroll-animations">
                <div class="container">
                    <div class="row ">
                        <div class="col-sm-3 ">
                            <div class="icon animated">
                                <i class=" fas fa-award text_primary fa-3x"></i>
                            </div>
                            <p class="pt-3 animated">#1 company for <br>speed dating in Calgary</p>
                        </div>
                        <div class="col-sm-3 animated">
                            <div class="icon">
                                <i class="fas fa-glass-cheers text_primary fa-3x"></i>
        
                            </div>
                            <p class="pt-3 animated">Exciting events <br>monthly</p>
                        </div>
                        <div class="col-sm-3 animated">
                            <div class="icon">
                                <i class="far fa-kiss-wink-heart text_primary fa-3x"></i>
                            </div>
                            <p class="pt-3">80%+<br>match rate</p>
                        </div>
                        <div class="col-sm-3 animated">
                            <div class="icon">
                                <i class="fas fa-clock text_primary fa-3x"></i>
                            </div>
                            <p class="pt-3">18 years<br>of experience</p>
                        </div>
                        <!-- <div class="col-sm-2">
                            <div class="icon">
                                <i class="fas fa-users text_primary fa-3x"></i>
                            </div>
                            <p class="pt-3">46k+ active <br>members</p>
                        </div>
                        <div class="col-sm-2">
                            <div class="icon">
                                <i class="fas fa-city text_primary fa-3x"></i>
                            </div>
                            <p class="pt-3">24<br>UK cities</p>
                        </div> -->
                    </div>
                </div>
            </div>
            <div class="service_text text-center pt-5 pb-5">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <p class="p-0 m-0 text-white text-big">Calgary Speed Dating holds the 
                                 Guinness World Records for the largest speed dating in event. <br> 651 people attend our event on February 14th, 2014.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <section class="text-center mt-5 ">
            <div class="row">
                <div class="col-md-12 col-lg-6">
                    <h2>Cupid is in Calgary</h2>
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/9fFCMcM9LN8?rel=0" title="YouTube video player"
                    frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
                </div>
                <div class="col-md-12 col-lg-6">
                    <h2>How Calgary Speed Dating Events Work</h2>
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/lv7eTs2clGg?rel=0"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
                </div>
            </div>
        </section>
            <section class="events_listing_home main_padding">
                    {{-- container-main-events   --}}
                <div class="container">
                
                <div class="row">
                        <div class="col-12">
                            <h2 class="text-center p-0 mb-4 section-title ">Upcoming Events</h2>
                        </div>
                    </div>
                    <div id="load-home-events-data">
                    
                    <div class="row">
                            @foreach($events as $event)  
                        <div class="col-10 offset-1">
                            <div class="event_container mb-5 ">
                                <div class="event_image">
                                    <a href="{{route('frontend.event.show', [$event->id, $event->slug] )}}"><img class="lozad" data-src="{{$event->main_image}}" alt="Event image"></a>
                                    {{-- {{ URL::asset('frontend/images/event-image.png')}} --}}
                                </div> 
                                <div class="event_description shadow">
                                    <div class="row pb-3 pt-4">
                                        <div class="col-lg-2 col-sm-2">
                                            <h2 class="event_date pl-5 mb-0 font-weight-bold">{{date("j", strtotime($event->start_datetime))}}</h2>
                                            <h6 class="event_month pl-5 mb-0">{{date("M", strtotime($event->start_datetime))}}</h6>
                                            <h6 class="event_day pl-5">{{date("D", strtotime($event->start_datetime))}}</h6>
   
                                        </div>
                                        {{-- F: {{$event->details->female_age_from}}-{{$event->details->male_age_to}}  , M: {{$event->details->male_age_to}}-{{$event->details->male_age_to}} --}}
                                        <div class="col-lg-7 col-sm-10 event_detail_description">
                                            <a href="{{route('frontend.event.show', [$event->id, $event->slug] )}}">
                                                <h3 class="event_title "><i class="far fa-clock text_primary mr-2"></i> {{$event->title}} #{{$event->id}}</h3>
                                            </a>
                                            
                                            <div class="row mt-3">
                                                <div class="col-sm-8">
                                                    <p class="mb-2 d-flex"><span class="text_primary mr-3"><strong>Where:</strong></span>
                                                        <a target="_blank" href="http://maps.google.com/?q={{ $event->address }}">{{$event->address}}</a>
                                                    </p>
                                                </div> 
                                                <div class="col-sm-4">
                                                    <p class="mb-2"><span class="text_primary"><strong>Time:
                                                            </strong></span> {{date("g:i a", strtotime($event->start_datetime))}}</p>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="row">
                                                @if ($event->type != 2)
                                                <div class="col-sm-8">
                                                   
                                                    <p><span class="text_primary mr-1"><strong>Women: </strong></span>
                                                        @if($event->users()->whereGender(1)->count() >= $event->f_limit)
                                                        <span class="badge badge-pill badge-danger">Sold Out</span>
                                                        @else
                                                        Available
                                                        @endif
                                                        </p>

                                                        <p><span class="text_primary mr-1"><strong>Women Price: </strong></span>{{$event->price_female}}</p> 
                                                </div>
                                                @endif
                                                @if ($event->type != 1)
                                                <div class="col-sm-4">
                                                    <p><span class="text_primary"><strong>Men: </strong></span>
                                                    @if($event->users()->whereGender(0)->count() >= $event->limit)
                                                    <span class="badge badge-pill badge-danger">Sold Out</span>
                                                    @else
                                                    Available
                                                    @endif
                                                    <p><span class="text_primary mr-1"><strong>Men Price: </strong></span>{{$event->price_male}}</p> 
                                                </div>
                                                @endif
                                             

                                                </div>
                                        </div>
                                        
                                        <!-- event-signup.html -->
                                        <div class="col-lg-3 text-center">

                                                {{-- <h5 class="mt-2"><span class="text_primary"></span>$55.00</h5> --}}
                                            <!--<h5 class="mt-2"><span class="text_primary"><del>£20.00</del></span>£10.00</h5>-->
                                        
                                        <a href="{{route('frontend.event.show', [$event->id, $event->slug] )}}" class="btn btn-theme btn-lg">Register</a><br>
                                        @auth
                                          
                                        
                                        @foreach($event->users as $users)
                                        @endforeach
                                        @if($event->users->contains($logged_in_user->id) && $users->pivot->paid == 1 )
                                        <span class="badge badge-success">Registered</span>
                                        @endif
                                        @if($event->users()->whereGender(0)->count() == $event->limit && $event->users()->whereGender(1)->count() == $event->f_limit)
                                       
                                        <span class="badge badge-danger">Sold out</span>
                                        @endif
                                        @endauth
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    </div>
                    {{-- <a href="{{route('frontend.events.index')}}" class="btn btn-theme">FIND EVENTS</a> --}}
                    @if($events->hasMorePages() == 1)
                    <div class="text-center pb-5"><button id="load-more-home" type="button" class="btn btn-theme btn-lg" data-page="{{ $events->currentPage() }}">View More</button></div>
                    
                    @endif
                </div>
               
                <div class="text-center mt-5"><div style="width:100%;height:100%" class="lds-dual-ring"><div></div> 
    
                <input type="hidden" name="home_load_url" id="home-load-url" value="{{ route('frontend.home.events.load') }}">
            </section>

            
            {{-- <div class="text-center  pb-5">
                    <a href="{{route('frontend.events.index')}}" class="btn btn-theme p-3 front-more-button">MORE EVENTS</a> 
            </div> --}}
      
            <section class="company_logo text-center pt-5 pb-5">
                {{-- <div class="container"> container-main-events--}}
                        <div class="container">
                         


                    <div class="row">
                        <div class="col-12">
                            <h2 class="p-0 m-0 section-title ">Featured in</h2>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-lg-6">
                            <img src="{{ URL::asset('frontend/images/media/herald.png')}}" alt="logo" class="mr-4 mb-3" style="height: 100px;">
                        </div>

                        
                        <div class="col-lg-6">
                            <img src="{{ URL::asset('frontend/images/media/guiness.png')}}" alt="logo" class="mr-4 mb-3" style="height: 100px;">
                        </div>
                        {{-- <div class="col-lg-3">
                            <img src="images/the-guardian-logo.png" alt="logo" class="mr-4 mb-3">
                        </div>
                        <div class="col-lg-3">
                            <img src="images/itv-logo.png" alt="logo" class="mb-5">
                        </div> --}}
                    </div>
                </div>
            </section>
            {{-- Testimonials --}}
            <section class="user_reviews main_padding">
                <div class="container">
                    <div class="row">
                        <div class="col-12 text-center">
                            <h2 class="p-0 m-0 section-title">Testimonials!</h2>
                            <p class="mt-2">All of the testimonials below are from real Calgarians. They have all been to a Calgary Speed Dating event.</p>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-12">
                            <div class="owl-carousel">
                                    <div class="d-flex carousel_item">
                                            <div class="image pr-4">
                                                {{-- <img src="images/user1.png" alt="user"> --}}
                                            </div>
                                            <div class="user-description">
                                                <div class="user-star-rating">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                </div>
                                                <h4 class="mt-2"> Leanne</h4>
                                                <p>Hi, I was just thinking about my experience with Calgary Speed Dating when I met my husband Joe. We were married just over a year later. That was a long time ago because that was 15 years ago!!! 15 YEARS! We are so grateful to have met that night!</p>
                                            </div>
                                    </div>

                                    <div class="d-flex carousel_item">
                                            <div class="image pr-4">
                                                {{-- <img src="images/user1.png" alt="user"> --}}
                                            </div>
                                            <div class="user-description">
                                                <div class="user-star-rating">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                </div>
                                                <h4 class="mt-2"> Marie</h4>
                                                <p>Just wanted to say what a “neat” experience I had. I have not done on-line dating ever, and that was my first speed-dating ever. Thoroughly enjoyed the location at Rodney’s!</p>
                                            </div>
                                    </div>

                                    <div class="d-flex carousel_item">
                                            <div class="image pr-4">
                                                {{-- <img src="images/user1.png" alt="user"> --}}
                                            </div>
                                            <div class="user-description">
                                                <div class="user-star-rating">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                </div>
                                                <h4 class="mt-2"> Jessica</h4>
                                                <p>I did have a great evening. Everything was very well organized and the staff were very friendly and professional</p>
                                            </div>
                                    </div>




                                        
                                <div class="d-flex carousel_item">
                                    <div class="image pr-4">
                                        {{-- <img src="images/user1.png" alt="user"> --}}
                                    </div>
                                    <div class="user-description">
                                        <div class="user-star-rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <h4 class="mt-2">Erin &amp; Alex</h4>
                                        <p>We met through Calgary Speed Dating and immediately hit it off! In less than two years we were married and are living a very joyful life together! 
                                            Thank you Cathy for hosting such a fun and respectful event - we are so grateful.</p>
                                    </div>
                                </div>
                                <div class="d-flex carousel_item">
                                    <div class="image pr-4">
                                        {{-- <img src="images/user1.png" alt="user"> --}}
                                    </div>
                                    <div class="user-description">
                                        <div class="user-star-rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <h4 class="mt-2">Don</h4>
                                        <p>It's been nearly 6 and 1/2 years that Catherine and I met at CalgarySpeedDating.com and have never looked back. Thank you for running a quality service that allowed this introvert guy to meet a great extrovert girl!.</p>
                                    </div>
                                </div>
                                
                                <div class="d-flex carousel_item">
                                    <div class="image pr-4">
                                        {{-- <img src="images/user1.png" alt="user"> --}}
                                    </div>
                                    <div class="user-description">
                                        <div class="user-star-rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <h4 class="mt-2">Steve</h4>
                                        <p>I would like to compliment you on doing a great job on your Speed Dating events, they are a lot of FUN! Everyone that I talked to were enjoying themselves and will certainly pass your events on to their friends. </p>
                                    </div>
                                </div>

                                <div class="d-flex carousel_item">
                                        <div class="image pr-4">
                                            {{-- <img src="images/user1.png" alt="user"> --}}
                                        </div>
                                        <div class="user-description">
                                            <div class="user-star-rating">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <h4 class="mt-2">Susan</h4>
                                            <p>Just letting you know that my match and I are dating. Things are going very well, he could be the one, if not he's pretty damn close and we are going to have fun finding out! Thanks for the evening, it was great.</p>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            {{-- Venues --}}
            {{-- <section class="venu_section main_padding text-center ">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="p-0 m-0 section-title text-white">Browse events by category</h2>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-lg-4">
                            <a href="#">
                                <div class="card pb-4 shadow mb-4">
                                    <img src="images/venu_image_1.png" alt="logo">
                                    <h4 class="pt-4 pb-2">BE HUMAN</h4>
                                    <p class="pl-3 pr-3">Give your phone the night off and venture out into the real world.
                                        People
                                        at our events want
                                        to shake your hand, share a smile and get to know you.</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4">
                            <a href="#">
                                <div class="card pb-4 shadow mb-4">
                                    <img src="images/venu_image_1.png" alt="logo">
                                    <h4 class="pt-4 pb-2">BE HUMAN</h4>
                                    <p class="pl-3 pr-3">Give your phone the night off and venture out into the real world.
                                        People
                                        at our events want
                                        to shake your hand, share a smile and get to know you.</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4">
                            <a href="#">
                                <div class="card pb-4 shadow mb-4">
                                    <img src="images/venu_image_1.png" alt="logo">
                                    <h4 class="pt-4 pb-2">BE HUMAN</h4>
                                    <p class="pl-3 pr-3">Give your phone the night off and venture out into the real world.
                                        People
                                        at our events want
                                        to shake your hand, share a smile and get to know you.</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </section> --}}
            {{-- Blog --}}
            {{-- <section class="blog main_padding bg-grey">
                <div class="container">
                    <div class="row">
                        <div class="col-12 text-center">
                            <h2 class="p-0 m-0 section-title">Read our blog!</h2>
                            <p class="mt-2">Catch up on dating advice, date ideas and more!</p>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-lg-4 mb-4">
                            <div class="blog_image">
                                <img src="images/blog-1.jpg" alt="logo" class="mr-4">
                            </div>
                            <div class="blog_desc mt-3">
                                <a href="blog-single.html" class="text-dark">
                                    <h6>Consciously Coupling Or Just Cuffing Season?</h6>
                                </a>
                                <p class="text-muted">posted on 2018-12-05 10:11:12 by Sarah</p>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-4">
        
                            <div class="blog_image">
                                <img src="images/blog-1.jpg" alt="logo" class="mr-4">
                            </div>
                            <div class="blog_desc mt-3">
                                <a href="blog-single.html" class="text-dark">
                                    <h6>Consciously Coupling Or Just Cuffing Season?</h6>
                                </a>
                                <p class="text-muted">posted on 2018-12-05 10:11:12 by Sarah</p>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-4">
                            <div class="blog_image">
                                <img src="images/blog-1.jpg" alt="logo" class="mr-4">
                            </div>
                            <div class="blog_desc mt-3">
                                <a href="blog-single.html" class="text-dark">
                                    <h6>Consciously Coupling Or Just Cuffing Season?</h6>
                                </a>
                                <p class="text-muted">posted on 2018-12-05 10:11:12 by Sarah</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section> --}}
            {{-- <section class="tweets main_padding">
                <div class="container">
                    <div class="row">
                        <div class="col-12 text-center">
                            <h2 class="p-0 m-0 section-title">Latest SpeedDater tweets!</h2>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-4 mb-4">
                            <a href="#">
                                Friday essentials... What are your plans for tonight? #fridayvibes #fridaymood #cocktails
                                #fridayfeeling #friyay… https://t.co/5QNRM7ujyu
                            </a>
                        </div>
                        <div class="col-md-4 mb-4">
                            <a href="#">
                                Friday essentials... What are your plans for tonight? #fridayvibes #fridaymood #cocktails
                                #fridayfeeling #friyay… https://t.co/5QNRM7ujyu
                            </a>
                        </div>
                        <div class="col-md-4 mb-4">
                            <a href="#">
                                Friday essentials... What are your plans for tonight? #fridayvibes #fridaymood #cocktails
                                #fridayfeeling #friyay… https://t.co/5QNRM7ujyu
                            </a>
                        </div>
        
                    </div>
                    <div class="follow_us text-center mt-3">
                        <a href="#" class="btn btn-theme mt-4 pt-3 pb-3 pr-3 pl-3">FOLLOW US ON TWITTER <i class="fab fa-twitter ml-1"></i></a>
                    </div>
                </div>
            </section> --}}

            
            <section class="subscribe main_padding bg-grey">
                <div class="container">
                    <div class="row">
                        <div class="col-12 text-center">
                            <h2 class="p-0 m-0 section-title">Be Notified of Future Events
                            </h2>
                            <p class="mt-2 pl-5 pr-5">Get updated when new events are posted.
                            </p>
                            <form id="newsletter" class="d-flex mt-5 w-50 mr-auto ml-auto">
                                <input type="text" class="form-control form-control_lg" name="formInput[Email Address]" id="email"
                                    placeholder="Email Address" required>
                                <button type="submit" class="btn btn-theme btn-lg btn-subs">Subscribe</button>
                            </form>
                        </div>
                    </div>
        
                </div>
            </section>
            <!-- End Sections -->


<!-- Modal -->
@if (Auth::check()) {
<div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-labelledby="newModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="newModalLabel">Profile Details</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                Are are all your profile details correct? <br><br>
                Please update here<br><br>
                <a href="{{ route('frontend.user.account')}}" type="button" class="btn btn-theme btn-lg">Profile</a>
                <br><br> Thanks
            </div>
            {{-- <div class="modal-footer">
                    <a href="{{ route('frontend.auth.password.reset') }}"  class="btn btn-primary">Reset Password</a>
                    <a href="{{route('frontend.events.index')}}"  class="btn btn-success" >Browse</a>
                  </div> --}}
          </div>
        </div>
      </div>
@endauth



    {{-- <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-home"></i> @lang('navs.general.home')
                </div>
                <div class="card-body">
                    @lang('strings.frontend.welcome_to', ['place' => app_name()])
                </div>
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->

    <div class="row mb-4">
        <div class="col">
            <example-component></example-component>
        </div><!--col-->
    </div><!--row-->

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <i class="fab fa-font-awesome-flag"></i> Font Awesome @lang('strings.frontend.test')
                </div>
                <div class="card-body">
                    <i class="fas fa-home"></i>
                    <i class="fab fa-facebook"></i>
                    <i class="fab fa-twitter"></i>
                    <i class="fab fa-pinterest"></i>
                </div><!--card-body-->
            </div><!--card-->
        </div><!--col-->
    </div><!--row--> --}}
@push('after-scripts')
<script>
$(".lds-dual-ring").hide();
$('#newModal').modal('show');
//  var nodeshown = localStorage.getItem('nodeshown');
// $(window).on('load',function(){
//     if (nodeshown == null) {
//         localStorage.setItem('nodeshown', 1);
//         $('#newModal').modal('show');
//     }
    
// });
$(document).ready(function() {
  // Check if element is scrolled into view
  function isScrolledIntoView(elem) {
    var docViewTop = $(window).scrollTop();
    var docViewBottom = docViewTop + $(window).height();

    var elemTop = $(elem).offset().top;
    var elemBottom = elemTop + $(elem).height();

    return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
  }
  // If element is scrolled into view, fade it in
  $(window).scroll(function() {
    $('.scroll-animations .animated').each(function() {
      if (isScrolledIntoView(this) === true) {
        $(this).addClass('fadeInLeft');
      }
    });
  });



// Load More
let defaultPage = 2
    $('#load-more-home').click(function () {
        let load_home_url = $('#home-load-url').val();
        // $("#load-more").html("Loading....");
        $.ajax({
            type: 'GET',
            url: load_home_url,
            data: {
                page:defaultPage,
            },
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            beforeSend: function(){
            // Show image container
            $("#load-more-home").hide();
            $(".lds-dual-ring").show();
            
            },
            success: function (data) {
                // console.log(data);
                defaultPage = data.page +1
                $('#load-home-events-data').append(data.html);
                $("#load-more-home").show();
                if(data.hasMorePages==false){
                   $('#load-more-home').remove()
                //    swal("Oops...", "No upcoming events", "error");
                }
                
            },
            complete:function(data){
            // Hide image container
            $(".lds-dual-ring").hide();
            },
            error: function (xhr, type) {
                alert('Ajax error!')
            }
        });
    })





});

</script>

@endpush
@endsection
