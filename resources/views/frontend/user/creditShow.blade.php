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
<div class="row mb-3">
    <div class="col col-sm-10">
        <h3 class="btn btn-success ml-3 credit-btn-total">Total Credit: {{$credit_count}}</h3>
        @if($credit_count>0)
        <a class="use-credit" data-id="{{$credit_count}}" data-link="{{route('frontend.events.index')}}">
            <h3 class="btn btn-danger ml-3 credit-btn-total">Use Credit</h3>
        </a>
        @endif
    </div>
</div>
<div class="row mb-3">
    <div class="col-6 col-sm-12 col-xs-12 col-lg-6 col-xl-6">
        <div class="card">
            <div class="card-body">  
                <h3>Cancelled Events</h3>      
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Event</th>
                            <th scope="col">Date</th>

                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach ($credits as $credit)
                        <tr>
                            <td>
                                {{$credit->events->title}}
                            </td>
                            <td>{{ date("F j, Y, g:i a", strtotime($credit->created_at)) }}</td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-6 col-sm-12 col-xs-12 col-lg-6 col-xl-6">
        <div class="card">
            <div class="card-body">        
                <h3>Credit from Friends: {{$credit_count_friend}}</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Friend Name</th>
                            <th scope="col">Credit</th>
                            <th scope="col">Date</th>

                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach ($friends as $friend)
                        <tr>
                            <td>
                                {{$friend->users->first_name}} {{$friend->users->last_name}}
                            </td>
                            <td>
                                {{$friend->count}}
                            </td>
                            <td>{{ date("F j, Y, g:i a", strtotime($friend->created_at)) }}</td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@push('after-scripts')
<script>
    $('.use-credit').on('click',function () {
        debugger;
        var credit = $(this).data("id");
        var events = $(this).data("link");
        localStorage.setItem("credit",credit);
        window.location.replace(events);
    });
</script>
@endpush
@endsection
