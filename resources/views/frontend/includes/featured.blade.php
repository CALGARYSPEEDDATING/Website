<div class="container">
    <div class="row">
        <div class="col-12 text-center">
            <h2 class="p-0 m-0 section-title mb-5">Featured Events</h2>
        </div>
    </div>

    <div class="row">
        @foreach($feature_events as $feature_event)
        <div class="col-md-6">
            <div class="card featured_events_card shadow pb-4 mb-5 border-0">
                <div class="feautured_events_image positive-relative">
                    <img src="{{$feature_event->main_image}}" alt="Calgary Speed Dating logo">
                    {{-- {{URL::asset('frontend/images/feature_event.png')}} --}}
                    <div class="feature_event_pub_date">
                        <h2 class="event_date mb-1 font-weight-bold">
                            {{date("j", strtotime($feature_event->start_datetime))}}</h2>
                        <h6 class="event_month mb-1">{{date("M", strtotime($feature_event->start_datetime))}}</h6>
                        <h6 class="event_day">{{date("D", strtotime($feature_event->start_datetime))}}</h6>
                    </div>
                </div>
                <div class="feature_events_description">

                    <a href="{{route('frontend.event.show', $feature_event->id)}}">
                        <h4 class="p-4 text-dark">{{$feature_event->title}} #{{$feature_event->slugId}}</h4>
                    </a>
                    <div class="row">
                        <div class="col-7 ">
                            <p class="pl-4 d-flex"><i class="fal fa-map-marker-alt text_primary mr-2 mt-1"></i>
                                {{$feature_event->address}}</p>
                        </div>
                        <div class="col-5 ">
                            <p class="pr-4"><strong class="text_primary">Time:</strong>
                                {{date("g:i a", strtotime($feature_event->start_datetime))}} </p>
                        </div>
                    </div>





                    <div class="clearfix"></div>
                    <div class="row">
                        @if ($feature_event->type != 2)
                        <div class="col-7">
                            <p class="pl-4"><strong class="text_primary">Women:</strong>
                                @if($feature_event->users()->whereGender(1)->count() >= $feature_event->f_limit)
                                <span class="badge badge-pill badge-danger">Sold Out</span>
                                @else
                                Available
                                @endif
                            </p>
                           
                        </div>
                        @endif
                        @if ($feature_event->type != 1)
                        <div class="col-5">
                            <p class="pr-4"><strong class="text_primary">Men:</strong>
                                @if($feature_event->users()->whereGender(0)->count() >= $feature_event->limit)
                                <span class="badge badge-pill badge-danger">Sold Out</span>
                                @else
                                Available
                                @endif

                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        {{-- <div class="col-md-6">
                <div class="card featured_events_card shadow pb-4 border-0">
                    <div class="feautured_events_image positive-relative">
                        <img src="images/feature_event.png" alt="Giant Valentine's Speed Dating">
                        <div class="feature_event_pub_date">
                            <h2 class="event_date mb-1 font-weight-bold">5</h2>
                            <h6 class="event_month mb-1">Feb</h6>
                            <h6 class="event_day">Tue</h6>
                        </div>
                    </div>
                    <div class="feature_events_description">
                        <a href="#">
                            <h4 class="p-4 text-dark">Giant Valentine's Speed Dating - tickets on sale
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
            </div> --}}
    </div>

</div>
