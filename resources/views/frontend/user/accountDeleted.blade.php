@extends('frontend.layouts.app')
@push('after-styles')
<style>
.question-mark:hover .tooltiptext{
    cursor: pointer !important;
    visibility: visible !important;
}

  .question-mark .tooltiptext {
    visibility: hidden !important;
    width: 225px;
    background-color: #000000e3;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 10px 20px;

    /* Position the tooltip */
    position: absolute;
    z-index: 1;
    text-align: justify;
  }

  .tooltip:hover .tooltiptext {
    visibility: visible;
  }
</style>
@endpush

@section('title', app_name() . ' | ' . __('Account Deleted'))

@section('content')

<section class="main_padding">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1>Your account is deleted!</h1>
            </div>
        </div>
    </div>
</section>

    <!-- Featured -->
    <section id="featured_events" class="pt-5 pb-5 bg-grey">
            @include('frontend.includes.featured') 
    </section>
@endsection