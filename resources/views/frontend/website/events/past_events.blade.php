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
      .payment-popup{
        text-align: center;
      }
      </style>

@endpush
@section('meta_description', 'Register for one of our upcoming speed dating events in Calgary. For those in their 20s, 30s, 40s, and over 50. Meet 12 singles at our monthly events.')
@section('title',  __('20s, 30s, 40s, 50s, and 60s Speed Dating Events in Calgary'))
<!-- @section('title', app_name() . ' | ' . __('labels.frontend.contact.box_title')) -->

@section('content')

{{-- <section id="featured_events" class="pt-5 pb-3">
        @include('frontend.includes.featured')
    </section>
    <hr> --}}
    <section class="events_listing_home main_padding">
        <div  class="container">
          <div id="load-data">
            <div class="row">
                <div style="margin:0 auto;">
                    <center>
                        <h2 class="mb-3" style="background-color:red; color:white;padding:5px" href="{{route('frontend.pastEvents')}}">Past Singles Events</h2>
                    </center>
                </div>
            </div>
            <div class="row" >
                <div class="col-10 offset-1 mb-3">
                    <h2 class="text-center">#1 speed dating events in Calgary. 100s of happy couples matched. Book today!</h2>
                    <!-- <h2>Upcoming Events - Register Below</h2> -->
                </div>
                    @foreach($events as $event)
                <div class="col-10 offset-1 ">
                    <div class="event_container mb-5 ">
                        <div class="event_image">
                            <a href="{{route('frontend.pastEventDetailShow', [$event->id, $event->slug] )}}"><img class="lozad" data-src="{{$event->main_image}}" alt="Event image"></a>
                        </div>
                        <div class="event_description shadow">
                            <div class="row pb-3 pt-4">
                                <div class="col-lg-2 col-sm-2">
                                    <h2 class="event_date pl-5 mb-0 font-weight-bold">{{date("j", strtotime($event->start_datetime))}}</h2>
                                    <h6 class="event_month pl-5 mb-0">{{date("M", strtotime($event->start_datetime))}}</h6>
                                    <h6 class="event_day pl-5">{{date("D", strtotime($event->start_datetime))}}</h6>

                                </div>
                                <div class="col-lg-7 col-sm-10 event_detail_description">
                                    <a href="{{route('frontend.pastEventDetailShow', [$event->id, $event->slug] )}}">
                                        <h3 class="event_title "><i class="far fa-clock text_primary mr-2"></i> {{$event->title}} #{{$event->slugId}}</h3>
                                    </a>

                                    <div class="row mt-3">
                                        <div class="col-sm-8">
                                            <p class="mb-2 d-flex"><span class="text_primary mr-3"><strong>Where:</strong></span>
                                                <a target="_blank" href="http://maps.google.com/?q={{ $event->address }}">{{$event->address}}</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 text-center">
                                    <a href="{{route('frontend.events.index')}}" class="btn btn-theme btn-lg">Register</a><br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                @endforeach
        </div>

        {{ $events->links() }}
    </section>
@endsection


