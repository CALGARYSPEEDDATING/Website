@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.frontend.contact.box_title'))

@section('content')
<section id="blog_list" class="pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="p-0 m-0 section-title">SpeedDater Blog - All blogs</h2>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="blog_container mb-5">
                        <div class="blog_image">
                            <img src="images/blog-image.jpg" alt="blog image">
                        </div>
                        <div class="blog_description shadow p-4">
                            <div class="blog-head">
                                <div class="text_primary">
                                    <h6>News</h6>
                                </div>
                                <h3 class="blog-title">
                                    <a class="blog-title-link text-dark" href="blog-single.html">
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
                                First impressions always count but even more so when dating. A person will often
                                build up a picture of the kind of person you are just from how you're dressed. So
                                it's always important to consider what you're wearing when meeting new people. Even
                                more so when speed dating as you have limited time with a date to...
                            </div>
                            <div class="blog_btn mt-4">
                                <a href="blog-single.html" class="btn btn-theme blog_more_button">Read more</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="blog_container mb-5">
                        <div class="blog_image">
                            <img src="images/blog-image.jpg" alt="blog image">
                        </div>
                        <div class="blog_description shadow pl-4 pt-4 pb-4">
                            <div class="blog-head">
                                <div class="text_primary">
                                    <h6>News</h6>
                                </div>
                                <h3 class="blog-title">
                                    <a class="blog-title-link text-dark" href="blog-single.html">
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
                                First impressions always count but even more so when dating. A person will often
                                build up a picture of the kind of person you are just from how you're dressed. So
                                it's always important to consider what you're wearing when meeting new people. Even
                                more so when speed dating as you have limited time with a date to...
                            </div>
                            <div class="blog_btn mt-4">
                                <a href="blog-single.html" class="btn btn-theme blog_more_button">Read more</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="blog_container mb-5">
                        <div class="blog_image">
                            <img src="images/blog-image.jpg" alt="blog image">
                        </div>
                        <div class="blog_description shadow pl-4 pt-4 pb-4">
                            <div class="blog-head">
                                <div class="text_primary">
                                    <h6>News</h6>
                                </div>
                                <h3 class="blog-title">
                                    <a class="blog-title-link text-dark" href="blog-single.html">
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
                                First impressions always count but even more so when dating. A person will often
                                build up a picture of the kind of person you are just from how you're dressed. So
                                it's always important to consider what you're wearing when meeting new people. Even
                                more so when speed dating as you have limited time with a date to...
                            </div>
                            <div class="blog_btn mt-4">
                                <a href="blog-single.html" class="btn btn-theme blog_more_button">Read more</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled">
                                <a class="page-link" href="blogs.html" tabindex="-1">Previous</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="blogs.html">1</a></li>
                            <li class="page-item active">
                                <span class="page-link">
                                    2
                                    <span class="sr-only">(current)</span>
                                </span>
                            </li>
                            <li class="page-item"><a class="page-link" href="blogs.html">3</a></li>
                            <li class="page-item"><a class="page-link" href="blogs.html">4</a></li>

                            <li class="page-item">
                                <a class="page-link" href="blogs.html">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>

@endsection