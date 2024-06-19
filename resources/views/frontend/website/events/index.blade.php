@extends('frontend.layouts.app')
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
@section('title', app_name() . ' | ' . __('labels.frontend.contact.box_title'))

@section('content')

{{-- <section id="featured_events" class="pt-5 pb-3">
        @include('frontend.includes.featured')  
    </section>
    <hr> --}}
    <section class="events_listing_home main_padding">
        <div  class="container">
            {{-- <div class="row">
                <div class="col-12">
                    <div class="event_container mb-5">
                        <div class="event_image">
                            <a href="event-single.html"><img src="images/event-image.png" alt="Event image"></a>
                        </div>
                        <div class="event_description shadow">
                            <div class="row pb-3 pt-4">
                                <div class="col-lg-2 col-sm-2">
                                    <h2 class="event_date pl-5 mb-0 font-weight-bold">5</h2>
                                    <h6 class="event_month pl-5 mb-0">Feb</h6>
                                    <h6 class="event_day pl-5">Tue</h6>
                                </div>
                                <div class="col-lg-7 col-sm-10 event_detail_description">
                                    <a href="event-single.html">
                                        <h3 class="event_title "><i class="far fa-clock text_primary mr-2"></i> £10 OFF
                                            Speed Dating -
                                            GRADUATE...</h3>
                                    </a>

                                    <div class="row mt-3">
                                        <div class="col-sm-8">
                                            <p class="mb-2 d-flex"><span class="text_primary mr-3"><strong>Where:</strong></span>
                                                Lorem Ipsum is simply dummy text of the printing and</p>
                                        </div>
                                        <div class="col-sm-4">
                                            <p class="mb-2"><span class="text_primary"><strong>Age Group:
                                                    </strong></span>28-38</p>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <p><span class="text_primary mr-1"><strong>Women: </strong></span>
                                                Places Available</p>
                                        </div>
                                        <div class="col-sm-4">
                                            <p><span class="text_primary"><strong>Men: </strong></span>
                                                Places
                                                Available</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 text-center">
                                    <h5 class="mt-2"><span class="text_primary"><del>£20.00</del></span>£10.00</h5>
                                    <a href="event-signup.html" class="btn btn-theme btn-lg">Book Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="text-center d-block w-100">
                    <button type="button" class="btn btn-theme mt-3 btn-lg">Show More Events</button>
                </div>
            </div> --}}

          <div id="load-data">
            <div class="row" >
                <div class="col-10 offset-1 mb-3">
                    <h2>Upcoming Events - Register Below</h2>
                </div>
                    @foreach($events as $event)
                <div class="col-10 offset-1 ">
                 
                        {{-- <p>Start meeting Calgary singles in-person! Click on a link below to register. <strong>Remember there is 2-years leeway on each end of each age group!</strong> Location maps and pictures are below events list.</p> --}}
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
                                        @if ($event->type !=2)
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
                                            </p>
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
                                <span class="badge badge-danger">Sold Out</span>
                               
                                @endif
                                @endauth  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
               
                @endforeach
                {{-- @if($loop->last)
                @if($events->hasMorePages() == 1)
    
                <div class="text-center"><button id="btn-more" class="btn btn-theme btn-lg" data-url="{{ $events->nextPageUrl() }}">View More</button></div>
    
                @endif
                @endif --}}
            </div>
            </div>
           
           
            {{-- {{dd($events->nextPageUrl())}} --}}
            {{-- data-id="{{ $event->id }}" --}}
            {{-- <div id="remove-row">
                    <button id="btn-more" data-id="{{ $events->nextPageUrl() }}" class="btn btn-theme btn-lg"> Load More </button>
                </div> --}}
                @if($events->hasMorePages() == 1)
                <div class="text-center"><button id="load-more" type="button" class="btn btn-theme btn-lg" data-page="{{ $events->currentPage() }}">View More</button></div>
                
               @endif
               <div class="text-center"><div style="width:100%;height:100%" class="lds-dual-ring"><div></div>  
        </div>
     
        <input type="hidden" name="load_url" id="load_url" value="{{{ route('frontend.events.ajax.load') }}}">
    </section>
    @push('after-scripts')
    <script>
        $(".lds-dual-ring").hide();
            // $(document).ready(function(){
            //    $(document).on('click','#btn-more',function(){
            //        var load_url = $('#load_url').val();
            //        var id = $(this).data('id');
            //        var url = $(this).data("url");
            //         $("<div>").load(url + " #load-data", function() {
            //             console.log($(this).find("#listings"));
            //             // I took the content of only the listings from page 2 (or whatever page it happens to be)
            //             $("#load-data").append($(this).find("#load-data").html());

            //             });
                //    $("#btn-more").html("Loading....");
                //    $.ajax({
                //        url : load_url,
                //        method : "GET",
                //        data : {url:url, _token:"{{csrf_token()}}"},
                //        dataType : "text",
                //        success : function (data)
                //        {
                //         // console.log(data);
                //         $("<div>").load(url + " #load-data", function() {

                //         // I took the content of only the listings from page 2 (or whatever page it happens to be)
                //         $("#load-data").append($(this).find("#load-data").html());

                //         });
                //         $("#btn-more").html("View More");
                //         $(this).parent().remove();
                //         //   if(data != '') 
                //         //   {
                //         //       $('#remove-row').remove();
                //         //       $('#load-data').append(data);
                //         //   }
                //         //   else
                //         //   {
                //         //       $('#btn-more').html("No Data");
                //         //   }
                //        },
                //        error: function(msg) {
                //         // swal("Oops...", "Something went wrong!", "error");
                //         }
                //    });
            //    });  
            // }); 
    
    let defaultPage = 2
    $('#load-more').click(function () {
        let load_url = $('#load_url').val();
        // $("#load-more").html("Loading....");
        $.ajax({
            type: 'GET',
            url: load_url,
            data: {
                page:defaultPage,
            },
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            beforeSend: function(){
            // Show image container
            $("#load-more").hide();
            $(".lds-dual-ring").show();
            
            },
            success: function (data) {
                defaultPage = data.page +1
                $('#load-data').append(data.html);
                $("#load-more").show();
                // $("#load-more").html("View More");
                // $('#load-data').animate({ scrollTop: $("#loaded-data").offset().top }, 500);
                // $('body, html').animate({ scrollTop: $("#load-data").offset().top }, 500);
                // $('body, html').animate({scrollTop: $('#load-data').prop("scrollHeight")}, 500);
                // var htmlObject = $("<p></p>");
                // $('#loaded-data').append(htmlObject);
                // $('body, html').animate({ scrollTop: $(htmlObject).offset().top }, 500);
                if(data.hasMorePages==false){
                   $('#load-more').remove()
                   swal("Oops...", "No upcoming events", "error");
                }
                console.log(data);
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

            
            </script>
    @endpush
@endsection


