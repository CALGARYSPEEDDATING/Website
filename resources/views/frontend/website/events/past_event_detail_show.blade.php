
@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . $event->title)
@section('meta_seo_title', $event->seo_title)
@section('meta_description', $event->seo_description)

@section('content')

<section id="single_event" class="pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="event_single_image">
                            {{-- {{ URL::asset('frontend/images/blog-single-image.png')}} --}}
                    <img src="{{$event->main_image}}" alt="blog image">
                    </div>

                    <div class="event_detail bg-grey pt-4 pl-5 pr-5 pb-3">
                        <div class="row">
                            <div class="col-4 d-flex">
                                <div class="icon mr-3">
                                    <i class="fal fa-calendar-alt fa-2x text_primary"></i>
                                </div>
                                <div class="detail">
                                    <h5 class="font-weight-bold">START DATE</h5>
                                    <h5 class="text-muted">{{ date("l",
                                            strtotime($event->start_datetime)) }}, {{ date('F j, Y', strtotime($event->start_datetime)) }}  </h5>
                                </div>
                            </div>
                            <div class="col-4 d-flex">
                                <div class="icon mr-3">
                                    <i class="fal fa-clock fa-2x text_primary"></i>
                                </div>
                                <div class="detail">
                                    <h5 class="font-weight-bold">START TIME</h5>
                                    <h5 class="text-muted">{{date("g:i a", strtotime($event->start_datetime)) }} </h5>
                                </div>
                            </div>
                            {{-- <div class="col-3 d-flex">
                                <div class="icon mr-3">
                                    <i class="fal fa-wallet fa-2x text_primary"></i>
                                </div>
                                <div class="detail">
                                    <h5 class="font-weight-bold">COST</h5>
                                    <h5 class="text-muted">$ 39</h5>
                                </div>
                            </div> --}}


                            <div class="col-4 d-flex">
                                <div class="icon mr-3">
                                    <i class="fal fa-bookmark fa-2x text_primary"></i>
                                </div>
                                <div class="detail">
                                    <h5 class="font-weight-bold">TYPE</h5>
                                <h5 class="text-muted">{{0 ? 'Speed Dating' : ''}}
                                @if($event->type == 1)
                                Female Only
                                @elseif ($event->type == 2)
                                Male Only
                                @else
                                Standard
                                @endif

                                </h5>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="event_detail pt-4 pl-5 pr-5 pb-3">
                        <div class="row">
                            <div class="col-8 d-flex">
                                <div class="icon mr-3">
                                    <i class="fal fa-map-marker-alt text_primary fa-2x"></i>
                                </div>
                                <div class="detail">
                                    <h5 class="font-weight-bold">Location</h5>
                                    <h5 class="text-muted event_location">{{$event->address}}</h5>
                                </div>
                            </div>

                            <div class="col-3 d-flex">
                                <div class="icon mr-3">
                                    <i class="far fa-info-circle  text_primary fa-2x"></i>
                                </div>
                                <div class="detail">
                                    <h5 class="font-weight-bold">Venue</h5>
                                <a href="{{route('frontend.venue.index')}}" class="text-muted">See More</a>
                                </div>
                            </div>
                            {{-- <div class="col-3 d-flex">
                                <div class="icon mr-3">
                                    <i class="fal fa-city  text_primary fa-2x"></i>
                                </div>
                                <div class="detail">
                                    <h5 class="font-weight-bold">City</h5>
                                    <h5 class="text-muted">Ottawa</h5>
                                </div>
                            </div> --}}
                        </div>

                    </div>
                    <div class="event_content mt-5">

                        <div class="col-sm-12">
                            <h3>{{$event->title}} #{{$event->slugId}}</h3>
                            {!!$event->description!!}
                            {{-- Extra Questions --}}
                            <div id="accordion" class="mt-3">

                                <div class="card">
                                    <div class="card-header" id="headingfour">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapsefour"
                                                aria-expanded="true" aria-controls="collapsefour">
                                                Need more info about speed dating?
                                            </button>
                                        </h5>
                                    </div>

                                    <div id="collapsefour" class="collapse" aria-labelledby="headingfour" data-parent="#accordion">
                                        <div class="card-body">
                                            <p>At Calgary Speed Dating, we get together an average of 12 men and 12 women for fun, 7-minute dates - you decide if there's a match! Each participant has a dating card. You mark down who you'd like to see and everyone else does the same. If you say "yes" to the same people who say "yes" to you, it's a match and you get each other's contact information usually the same night. It's fun. It's simple. Come and see for yourself!
                                                </p>
                                                <p>Attention to detail, that's what Calgary Speed Dating is all about!</p>
                                                <ul>
                                                    <li>Events with even numbers of men and women (Once in awhile, there may be 1 more of a gender but you'll never come and find 9 women and 3 men attending.)</li>
                                                    <li>Events with no less than 9 men and 9 women but we prefer to have 12 of each at least</li>
                                                    <li>We keep track of every event you come to so that you don't meet a lot of the same people at future events</li>
                                                    <li>Participant profiles are provided with general answers about interests, dream vacations and passions, etc. Great ice breakers!</li>
                                                    <li>We take id to confirm that participants fit within the ages promised</li>
                                                    <li>We serve delicious appetizers</li>
                                                    <li>The rounds are 7 minutes - long enough to find out if there's a spark and quick enough to move on if you're not connecting</li>
                                                    <li>We’ve been serving Calgary Singles since 2001</li>
                                                </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingfive">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapsefive"
                                                aria-expanded="true" aria-controls="collapsefive">
                                                What to expect at a Calgary Speed Dating Event?
                                            </button>
                                        </h5>
                                    </div>

                                    <div id="collapsefive" class="collapse" aria-labelledby="headingfive" data-parent="#accordion">
                                        <div class="card-body">
                                            <p>Upon arriving, you'll register - be sure you bring id with your birth date on it - pick up your dating card and the profiles of the singles you'll be meeting. Beverages are available for purchase. You can either mingle or read the profiles to familiarize yourself with the other participants before you meet them.</p>
                                            <p>After a short welcome and explanation of how the dating cards work, the 7-minute dates commence. Choose to converse rather than interrogate. Conversation will put the other person at ease and those 7 minutes will fly by. </p>
                                            <p>Each person is assigned a table number. At the end of each 7 minutes, a bell rings and the men will move to the next highest table number. This is the time to secretly indicate on your dating card whether you'd like to see that person again. </p>
                                            <p>The break occurs around 8:30 and it will last 15-20 minutes. We supply the snacks! Then we resume until the end of the rounds. Events can end anywhere between 9:45 and 10:15, depending upon the size of the group.</p>
                                            <p>Just before you go home, you'll hand in your dating card, but take the profile sheet to help remind you who everyone is the next day. </p>
                                            <p>Expect an email with your matches usually the same night but before 1 p.m. the next day for sure. Once you have your matches the rest is up to you!</p>
                                            <p>Be aware that email servers can be sensitive and may consider "dating" a spam word. If you do not receive an email in your Inbox then check your Spam/junk mail folder. If you still do not have an email then text/call us at 403-219-3283 or email us at <span><a href="mailto:info@calgaryspeeddating.com?Subject=Hello%20">Here</a></span>. Best to put our email on your safe list.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h3 class="mt-5 section-title">Registration  <i data-toggle="tooltip" data-placement="top" title="{{ $event->details->more }}" class="fa fa-question-circle" aria-hidden="true"></i></h3>
                            <div class="tickets mt-4 ">
                                <a href="{{route('frontend.events.index')}}" class="btn btn-theme btn-lg">Register</a>
                            </div>

                    <div class="event_detail mt-3 pt-4 pl-5 pr-5 pb-3">
                        <div class="row">
                            <div class="col-4 d-flex">
                                <div class="icon mr-3">
                                    <i class="fal fa-flag text_primary fa-2x"></i>
                                </div>
                                <div class="detail">
                                    <h5 class="font-weight-bold">Country</h5>
                                <h5 class="text-muted event_country_name">CANADA</h5>
                                </div>
                            </div>
                            <div class="col-4 d-flex">
                                <div class="icon mr-3">
                                    <i class="fal fa-city text_primary fa-2x"></i>
                                </div>
                                <div class="detail">
                                    <h5 class="font-weight-bold">City</h5>
                                <h5 class="text-muted event_city_name">{{$event->city}}</h5>
                                </div>
                            </div>
                            <div class="col-4 d-flex">
                                <div class="icon mr-3">
                                    <i class="fal fa-map-pin text_primary fa-2x"></i>
                                </div>
                                <div class="detail">
                                    <h5 class="font-weight-bold">Postal Code</h5>
                                <h5 class="text-muted event_postal_code">{{$event->postal_code}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="event_detail pt-4 pl-5 pr-5 pb-3">
                        <div class="row">
                            <div class="col-4 d-flex">
                                <div class="icon mr-3">
                                    <i class="fal fa-calendar-alt fa-2x text_primary"></i>
                                </div>
                                <div class="detail">
                                    <h5 class="font-weight-bold">END DATE</h5>
                                    <h5 class="text-muted event_enddate">{{ date("l",
                                            strtotime($event->end_datetime)) }}, {{ date('F j, Y', strtotime($event->end_datetime)) }}  </h5>
                                </div>
                            </div>
                            <div class="col-4 d-flex">
                                <div class="icon mr-3">
                                    <i class="fal fa-clock fa-2x text_primary"></i>
                                </div>
                                <div class="detail">
                                    <h5 class="font-weight-bold">END TIME</h5>
                                    <h5 class="text-muted event_endtime">{{date("g:i a", strtotime($event->end_datetime)) }} </h5>
                                </div>
                            </div>
                            <div class="col-4 d-flex">
                                <div class="icon mr-3">
                                    <i class="fal fa-globe text_primary fa-2x"></i>
                                </div>
                                <div class="detail">
                                    <h5 class="font-weight-bold">Region</h5>
                                <h5 class="text-muted event_region_name">{{$event->region}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>

                        <span class="event_streetAddress" style="display:none;">{{$event->street_address}}</span>
                            <h3 class="mt-5 section-title">Share This Event
                            </h3>
                            <div class="blog_social_btn mt-4">

                                <a   href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" class="social-share btn btn_facebook_share mr-2 btn-lg"><i class=" fab fa-facebook-f mr-2 "></i>
                                    Share</a>
                                <a  href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}" class="social-share btn btn_twitter mr-2 btn-lg"><i class="fab fa-twitter mr-2"></i>
                                    Tweet</a>
                                {{-- <a target="_blank" href="https://plus.google.com/share?url={{ urlencode(urlencode(url()->current())) }}" class="btn btn_google_share mr-2 btn-lg "><i class="fab fa-google-plus-g mr-2"></i>share</a> --}}
                                <a  href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(url()->current()) }}&title={{ $event->title }}&summary={{ $event->title }}&source={{app_name()}}" class="social-share btn btn_twitter  btn-lg mr-2 "><i class="fab fa-linkedin mr-2"></i>
                                    Share</a>
                                <a  href="mailto:?Subject={{ $event->title }}&amp;Body=I%20saw%20this%20and%20thought%20of%20you!%20 {{ urlencode(url()->current()) }}" class="btn btn_google_share btn-lg "><i class="fal fa-envelope mr-2"></i>share</a>
                            </div>
                            {{-- Calendar --}}
                            <div class="row mt-3">
                                <div class="col-lg-3 mt-3">
                                    <a target="_blank"  href="{{$google_link}}"    class="btn btn-calender w-100">+ Add to Google Calendar</a>
                                </div>
                                <div class="col-lg-3 mt-3">
                                    <a  download="event.ics" href="{{$ics_link}}" class="btn btn-calender  w-100">+ iCal export</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="featured_events" class="pt-5 pb-5 bg-grey">
            @include('frontend.includes.featured')

    </section>

    @endsection

    @push('after-scripts')
   <script>
   $('#wait-list').click(function() {
        // var remove_interested_url = $("#remove_interested_url").val(),
        //     event_user_id = $(this).attr("data-event_user_id"),
        //     delay = 2000;

        alert('works');
        // if (confirm('Are you sure want to remove user')) {
        //     $.ajax({
        // url: remove_interested_url,
        // type:"DELETE",
        // data: {"id":event_user_id, _token: "{{ csrf_token() }}", _method: 'DELETE'},
        // success: function(data){
        //     alert("Success\n Interested volunteer remove from volunteer list");
        //     // swal("Success!", "Interested volunteer assigned to volunteer list", "success");
        //     setTimeout(function(){ location.reload(); }, delay);
        // },
        //     error: function(msg) {
        //     // swal("Oops...", "Something went wrong!", "error");
        //     }
        // });
        // }

    });




   </script>

   <script>
   var popupMeta = {
       width: 400,
       height: 400
   }
   $(document).on('click', '.social-share', function(event){
       event.preventDefault();

       var vPosition = Math.floor(($(window).width() - popupMeta.width) / 2),
           hPosition = Math.floor(($(window).height() - popupMeta.height) / 2);

       var url = $(this).attr('href');
       var popup = window.open(url, 'Social Share',
           'width='+popupMeta.width+',height='+popupMeta.height+
           ',left='+vPosition+',top='+hPosition+
           ',location=0,menubar=0,toolbar=0,status=0,scrollbars=1,resizable=1');

       if (popup) {
           popup.focus();
           return false;
       }
   });
   </script>

    @endpush
{{--
    &lt;a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::fullUrl()) }}"
    target="_blank"&gt;
    Share on Facebook
&lt;/a&gt;
&lt;a href="https://twitter.com/intent/tweet?url={{ urlencode(Request::fullUrl()) }}"
    target="_blank"&gt;
    Share on Twitter
&lt;/a&gt;
&lt;a href="https://plus.google.com/share?url={{ urlencode(Request::fullUrl()) }}"
    target="_blank"&gt;
    Share on Google
&lt;/a&gt; --}}
