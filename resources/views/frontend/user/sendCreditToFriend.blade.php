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
<div class="row justify-content-center align-items-center mb-3">
    <div class="col col-sm-10 align-self-center">

        <div class="card">
            <div class="card-body">
                <h3 class="btn btn-success credit-btn-total">Your Credit: {{$credit_count}}</h3>
                @if ($credit_count != 0)
                    <form action="{{route('frontend.user.sendCreditPost')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <input type="email" name="email" placeholder="Enter your friend's Email" class="form-control w-50"/>
                        </div>
                        <div class="form-group">
                            <input type="number" name="credit" placeholder="Enter credit" class="form-control w-50" min="1" max="{{$credit_count}}"/>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success mt-3" value="Submit"/>
                        </div>
                    </form>
                @else
                    <h5>When you have credit then you can send!</h5>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
