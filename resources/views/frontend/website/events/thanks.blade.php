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
@section('title', app_name() . ' | ' . __('labels.frontend.contact.box_title'))

@section('content')
    <section class="events_listing_home main_padding">
        <div  class="container">
            <div id="load-data">
                <div class="row" >
                    <div class="col-10 offset-1 mb-3">
                        <h2>Thank you for registering, we will see you at the event.</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('after-scripts')
<script>
    localStorage.removeItem('credit');
</script>
@endpush

