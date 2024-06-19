
<div class="row" id="loaded_data">
        @foreach($events as $event)
    <div class="col-10 offset-1">
        <div class="event_container mb-5 ">
            <div class="event_image">
                <a href="{{route('frontend.event.show', [$event->id, $event->slug] )}}"><img src="{{$event->main_image}}" alt="Event image"></a>
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
                            <h3 class="event_title "><i class="far fa-clock text_primary mr-2"></i> {{$event->title}}, #{{$event->id}}
                                (We have a 2yr leeway on the low and high end of the ages)</h3>
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
                                    @if($event->users()->whereGender(1)->count() >= $event->f_limit )
                                    <span class="badge badge-pill badge-danger">Sold Out</span>
                                    @else
                                    Available
                                    @endif
                                    </p>
                            </div>
                            @endif
                            @if ($event->type != 1)
                            <div class="col-sm-4">
                                <p><span class="text_primary"><strong>Men: </strong></span>
                                    @if($event->users()->whereGender(0)->count() >= $event->limit )
                                    <span class="badge badge-pill badge-danger">Sold Out</span>
                                    @else
                                    Available
                                    @endif
                                    </p>
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
                    <span class="badge badge-danger">Full</span>
                    @endif
                    @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
  
    @endforeach
</div>
