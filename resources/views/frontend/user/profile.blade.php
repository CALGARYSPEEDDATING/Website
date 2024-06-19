@extends('frontend.includes.sidebar')
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
@section('side-content')

@include('frontend.user.account.dating_profile')

@endsection
