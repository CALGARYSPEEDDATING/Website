@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.frontend.contact.box_title'))

@section('content')
<section id="blog_single" class="pt-5 pb-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-sm-12">
                    <a href="">
                        <h4 class="p-0 m-0"><i class="far fa-chevron-left text_primary mr-2"></i> Back to Blog</h4>
                    </a>

                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="blog_single_container mb-5">
                        <div class="blog_single_image">
                            <img src="images/blog-single-image.png" alt="blog image">
                        </div>
                        <div class="blog_single_description pl-4 pt-4 pb-4">
                            <div class="blog_single_head">
                                <div class="text_primary">
                                    <h6>News</h6>
                                </div>
                                <h3 class="blog_single_title">
                                    <a href="#" class="text-dark">
                                        Dating tips – How to Dress for Speed Dating!</a>
                                </h3>
                            </div>
                            <div class="blog-info mt-3 mb-3">
                                <div class="autor-photo-wrap lazy-hidden d-inline align-middle">
                                    <img src="images/blog_user_thumb.png" class="img-circle" alt="Blog User Image">
                                </div>
                                <div class="blog-autor ml-3 align-middle d-inline font-weight-bold">Sarah</div>
                                <div class="blog-date ml-2 text-muted align-middle  d-inline">4 Feb 2019</div>
                            </div>
                            <div class="blog-text">
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                    Ipsum
                                    has been the industry's standard dummy text ever since the 1500s, when an unknown
                                    printer took a galley of type and scrambled it to make a type specimen book. It has
                                    survived not only five centuries, but also the leap into electronic typesetting,
                                    remaining essentially unchanged. It was popularised in the 1960s with the release
                                    of
                                    Letraset sheets containing Lorem Ipsum passages, and more recently with desktop
                                    publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

                                <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                    Ipsum
                                    has been the industry's standard dummy text ever since the 1500s, when an unknown
                                    printer took a galley of type and scrambled it to make a type specimen book. It has
                                    survived not only five centuries, but also the leap into electronic typesetting,
                                    remaining essentially unchanged. It was popularised in the 1960s with the release
                                    of
                                    Letraset sheets containing Lorem Ipsum passages, and more recently with desktop
                                    publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                            </div>
                            <div class="blog_btn mt-4">
                                <a href="blog-single.html" class="btn btn-theme blog_more_button">Read more</a>
                            </div>

                            <div class="blog_social_btn mt-5 float-right">
                                <h6 class="align-middle d-inline mr-3 font-weight-bold">Share on social</h6>
                                <a href="https://www.facebook.com" class="btn btn_facebook_share mr-2"><i class="fab fa-facebook-f mr-2"></i>
                                    Share</a>
                                <a href="https://www.twitter.com" class="btn btn_twitter mr-2"><i class="fab fa-twitter mr-2"></i>
                                    Tweet</a>
                                <a href="https://www.plus.google.com" class="btn btn_google_share "><i class="fab fa-google-plus-g mr-2"></i>share</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="featured_events" class="pt-5 pb-5 bg-grey">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h2 class="p-0 m-0 section-title mb-5">Featured Events</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">

                    <div class="card featured_events_card shadow pb-4 mb-5 border-0">
                        <div class="feautured_events_image positive-relative">
                            <img src="images/feature_event.png" alt="logo">
                            <div class="feature_event_pub_date">
                                <h2 class="event_date mb-1 font-weight-bold">5</h2>
                                <h6 class="event_month mb-1">Feb</h6>
                                <h6 class="event_day">Tue</h6>
                            </div>
                        </div>
                        <div class="feature_events_description">

                            <a href="event-single.html">
                                <h4 class="p-4 text-dark">Giant Valentine's Speed Dating -
                                    tickets on
                                    sale now!</h4>
                            </a>
                            <div class="row">
                                <div class="col-7 ">
                                    <p class="pl-4 d-flex"><i class="fal fa-map-marker-alt text_primary mr-2 mt-1"></i>
                                        Lorem Ipsum is simply dummy text of the printing and</p>
                                </div>
                                <div class="col-5 ">
                                    <p class="pr-4"><strong class="text_primary">Age group:</strong>
                                        24-40</p>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="row">
                                <div class="col-7">
                                    <p class="pl-4"><strong class="text_primary">Women:</strong> Places
                                        Available</p>
                                </div>
                                <div class="col-5">
                                    <p class="pr-4"><strong class="text_primary">Men:</strong>
                                        Places
                                        Available</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-6">

                    <div class="card featured_events_card shadow pb-4 border-0">
                        <div class="feautured_events_image positive-relative">
                            <img src="images/feature_event.png" alt="logo">
                            <div class="feature_event_pub_date">
                                <h2 class="event_date mb-1 font-weight-bold">5</h2>
                                <h6 class="event_month mb-1">Feb</h6>
                                <h6 class="event_day">Tue</h6>
                            </div>
                        </div>
                        <div class="feature_events_description">
                            <a href="event-single.html">
                                <h4 class="p-4 text-dark">Giant Valentine's Speed Dating - tickets
                                    on sale
                                    now!</h4>
                            </a>
                            <div class="row">
                                <div class="col-7">
                                    <p class="pl-4 d-flex"><i class="fal fa-map-marker-alt text_primary mr-2 mt-1"></i>
                                        Lorem Ipsum is simply dummy text of the printing and</p>
                                </div>
                                <div class="col-5">
                                    <p class="pr-4"><strong class="text_primary">Age group:</strong>
                                        24-40</p>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="row">
                                <div class="col-7">
                                    <p class="pl-4"><strong class="text_primary">Women:</strong> Places
                                        Available</p>
                                </div>
                                <div class="col-5">
                                    <p class="pr-4"><strong class="text_primary">Men:</strong>
                                        Places
                                        Available</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

@endsection