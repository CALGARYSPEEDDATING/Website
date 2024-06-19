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
<div class="container">
    <div class="card">
        <div class="card-header">
            <strong>My Events</strong>
        </div>
        <div class="card-body">
            {{-- <div class="row">
                <div class="col-12 ">
                    <h2 class="p-0 m-0 section-title mb-5">My Events</h2>
                </div>
            </div> --}}
            <div class="row">
                @foreach($events as $feature_event)
                    @php
                        $check_waitlist = \App\Models\EventUser::where('event_id', $feature_event->id)->where('user_id', auth()->user()->id)->where('wait_list', 0)->first();
                    @endphp
                    @if ($check_waitlist)
                        <form method="post" action="{{ route('admin.event.profileMatches', $feature_event->id)}}">
                            @csrf
                            <input type="hidden" name="event_id" value="{{ $feature_event->id }}">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card featured_events_card shadow pb-4 mb-5 border-0">
                                        <div class="feautured_events_image positive-relative">
                                            <img src="{{$feature_event->main_image}}" alt="logo">
                                            {{-- {{URL::asset('frontend/images/feature_event.png')}} --}}
                                            <div class="feature_event_pub_date">
                                                <h2 class="event_date mb-1 font-weight-bold">{{date("j",
                                                    strtotime($feature_event->start_datetime))}}</h2>
                                                <h6 class="event_month mb-1">{{date("M", strtotime($feature_event->start_datetime))}}</h6>
                                                <h6 class="event_day">{{date("D", strtotime($feature_event->start_datetime))}}</h6>
                                            </div>
                                        </div>
                                        <div class="feature_events_description">
                                            <a href="{{route('frontend.event.show', $feature_event->id)}}">
                                                <h4 class="p-4 text-dark">{{$feature_event->title}} #{{$feature_event->id}}</h4>
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
                                                <div class="col-7">
                                                    <p class="pl-4"><strong class="text_primary">Women:</strong>

                                                    @if($feature_event->users()->whereGender(1)->count() >= $feature_event->limit)
                                                    <span class="badge badge-pill badge-danger">Sold Out</span>
                                                    @else
                                                    Available
                                                    @endif
                                                    </p>
                                                </div>
                                                <div class="col-5">
                                                    <p class="pr-4"><strong class="text_primary">Men:</strong>
                                                        @if($feature_event->users()->whereGender(0)->count() >= $feature_event->limit )
                                                        <span class="badge badge-pill badge-danger">Sold Out</span>
                                                        @else
                                                        Available
                                                        @endif
                                                        
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-7">
                                                    <!-- <p class="pl-4"><strong class="text_primary">Matches:</strong>
                                                        <a href="javascript:void(0)" class="matches" data-event_id = "{{ $feature_event->id }}">Show</a>
                                                    </p> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <form method="POST" action="{{route('frontend.user.cancelEvent')}}">
                                        @csrf
                                        <input type="hidden" name="event_id" id="event_id" value="{{$feature_event->id}}"/>
                                        <a href="javascript:void(0)" class="matches btn btn-success" data-event_id = "{{ $feature_event->id }}">Matches</a>
                                    </form>
                                </div>
                                @if ($now_time <= $feature_event->start_datetime)
                                    <div class="col-md-3">
                                        <input type="button" data-id="{{$feature_event->id}}" value="Cancel Event" class="btn btn-danger hour_check"/>
                                    </div>
                                @endif
                            </div>
                            <div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-labelledby="newModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="newModalLabel">Are you sure you want to submit</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <button type="button" class="btn btn-danger float-right cancel ml-3" onclick="cancel();">No</button>
                                            <button type="submit" class="btn btn-success float-right">Yes</button>
                                        
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="modal fade" id="validate" tabindex="-1" role="dialog" aria-labelledby="validateLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="newModalLabel">Validation</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <h3>Please select someone</h3>
                                        
                                    </div>
                                </div>
                                </div>
                            </div>
                        </form>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="col-12">
            <div class="mx-auto" style="width: 200px;">{{ $events->links() }}</div>
       </div>
    </div>
</div>


{{-- Here is modal for matches against an event --}}

<div id="match" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Matches</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
            <div class="show-match">
                <ul>
                </ul>
            </div>
        </div>
        <div class="modal-footer">
        </div>
    </div>
  </div>
</div>

<div id="hourCheckModal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Policy- </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{route('frontend.user.cancelEvent')}}">
        @csrf 
        <div class="modal-body">
            <h3 id="hourText"></h3>
            <input type="hidden" name="event_id" id="event_modal_id" value=""/>
        </div>
        <div class="modal-footer">
                <input type="submit" value="Cancel Event" class="btn btn-danger"/>
        </div>
      </form>
    </div>
  </div>
</div>
@push('after-scripts')
<script>
    $('.hour_check').on('click',function () {
        debugger;
        var event_id = $(this).data("id");
        localStorage.setItem("eventId",event_id);
        $.ajax({
            url:'{{ route("frontend.user.hourCheck") }}',
            type:'GET',
            data:{'event_id':event_id},
            success: function(data) {
                var id= localStorage.getItem("eventId");
                $('#event_modal_id').val(id);
                if(data=='yes'){
                    $('#hourText').text("If you cancel 48 hours or more from the event date, you will be issued a credit for a future event");  
                    $('#hourCheckModal').modal('show');
                }
                else{
                    $('#hourText').text("Less than 48 hours are left from the event date, you forfeit your payment")  
                    $('#hourCheckModal').modal('show');
                }
                
            }
        })
    });
    var siteurl = "{{url('/')}}";
    $(".matches").on("click", function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });                 
        $.ajax({
            type:'post',
            url: "{{ route('frontend.events.showmatch')}}",
            data: {id: $(this).data('event_id')},
            success: function(response)
            {
                html= '';
                $('.show-match ul').empty('');
                $.each(response,function(key, val) {
                    html+= '<li><a target="_blank" href="'+siteurl+'/profile/'+val.users.id+'"><img src='+siteurl+'/storage/'+val.users.avatar_location+' width="50px" class="mt-2 mr-4"/>'+val.users.first_name+'</a></li>'; 

                    });
                   $('.show-match ul').append(html);
            },
            error: function(jqXHR,error, errorThrown) {  
                if(jqXHR.status&&jqXHR.status==400){
                
                console.log(jqXHR.responseText)
                }else{
                    console.log('Something went wrong needs to debug')
                return false;
                }
            }
        });
        $('#match').modal('show');
    });
</script>

<script>
  function popupcall(){
    $('#match').modal('hide');
    $('#newModal').modal('show');
    // var chk_selected = 0;
    // var searchIDs = $('input:checked').map(function(){
    //   if($(this).val() != 1)
    //     chk_selected = 1;
    // });
    // if(chk_selected == 1)
    //   $('#newModal').modal('show');
    // else
    //   $('#validate').modal('show');
  }
  function cancel(){
    $('#newModal').modal('hide');
  }
</script>
@endpush


@endsection
{{-- //   html+= '<li><a target="_blank" href="{{route("frontend.user.profile", val.id)}}">'+val.first_name +' '+val.last_name+'</a></li>'; --}}