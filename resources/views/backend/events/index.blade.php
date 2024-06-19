@extends('backend.layouts.app')

@push('after-styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css" />
@endpush
<?php
$new_date = \Carbon\Carbon::now()->subDay(5)->toDateString();
?>
@section('title', app_name() . 'Events | Index' )

@section('content')

{{-- <h2 class="text-center">{{ isset($results) || isset($message) ? 'Filtered Results' : 'Manage Events' }}</h2> --}}


{{-- 
<div class="row">
<div class="col-sm-7">
    <div class="btn-toolbar float-right" role="toolbar" aria-label="">
        <a href="{{ route('admin.event.create') }}" class="btn btn-success ml-1" data-toggle="tooltip" title="Create Event"><i class="fas fa-plus-circle"></i></a>
        </div>
</div><!--col-->

</div> --}}
<div class="row">
  
    <div class="col">
        {{-- <div class="row">
            <div class="btn-toolbar float-right" role="toolbar" aria-label="">
                <a href="{{ route('admin.event.create') }}" class="btn btn-success ml-1" data-toggle="tooltip" title="Create Event"><i class="fas fa-plus-circle"></i></a>
                </div>
            </div> --}}
        
        <div class="container">
            <div class="row">
                <div class="col-sm-5 mb-4">
                    <h4 class="card-title mb-0">
                        {{ isset($results) || isset($message) ? 'Filtered Results' : 'Manage Events' }} <small class="text-muted">All Events</small>
                    </h4>
                </div><!--col-->
    
                <div class="col-sm-7">
                        <div class="btn-toolbar float-right" role="toolbar" aria-label="">
                                <a href="{{ route('admin.event.create') }}" class="btn btn-success ml-1" data-toggle="tooltip" title="Create Event"><i class="fas fa-plus-circle"></i></a>
                            </div>
                </div><!--col-->
            </div><!--row-->
          
        @include('backend.events.includes.manage.filter')

        @if(isset($results))
       {{-- Search Tags --}}
       <div class="row">

        <div class="col-md-12">
                @include('backend.events.includes.manage.tags')
        </div>    
           
        
       </div><br><br>
        @foreach($results as $event) 
        @include('backend.events.includes.manage.list')
        @endforeach

        @elseif(isset($message))
        <h2>{{ $message }}</h2>
        @else
       @foreach ($events as $event)
       <div class="row">
        {{-- <div class="col-md-1">
            @if($event->created_at >= $new_date)
            <span class="green">New</span>
              @endif
            
             <span class="green">{{ date("d", strtotime($event->start_time)) }}<sup>th</sup> {{ date("M",
                strtotime($event->start_time)) }} {{ date("y", strtotime($event->start_time)) }}</span>
        </div> --}}
        <div class="col-md-12 mb-3">
            <div class="list-group list-group-ov">
                <div class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                        <h4 class="mb-1">{{ $event->title }} #{{$event->id}}</h4>
                        <small class="text-muted">Created: {{$event->created_at->diffForHumans()}} </small>
                    </div>
    
                    <div class="row">
                        <div class="col-sm border-right">
                            <p class="in-block"><i class="far fa-clock"></i><span> {{ date("l",
                                    strtotime($event->start_datetime)) }}</span> {{
                                date("g:i a", strtotime($event->start_datetime)) }} - {{ date("g:i a",
                                strtotime($event->end_datetime)) }} <br>
                            <i class="fas fa-calendar-alt"></i> <span>  {{ date('F j, Y', strtotime($event->end_datetime)) }}    
                            </p>
    
    
                        </div>
                        <div class="col-sm border-right">
    
                                <a target="_blank" href="http://maps.google.com/?q= {{ $event->address }}"><p class="in-block"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                {{ $event->address }}</p></a>
                                 
                        </div>
                        <input type="hidden" id="duplicate_url" name="duplicate_url" value="{{route('admin.event.duplicate', [$event->id])}}">

                        
                        <div class="col-sm ">
                            <p class="in-block">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{route('admin.event.show', $event->id)}}" data-toggle="tooltip" data-placement="top" title="Show" class="btn btn-info"><i class="fas fa-eye"></i></a>
    
                                <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        More
                                      </button>
                                      
                                      <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                      <form action="{{route('admin.event.destroy', $event->id)}}" method="POST">
                                                @csrf
                                                {{-- @method('DELETE') --}}
                                                <button style="cursor:pointer" type="submit" class="dropdown-item" >Delete</button>
                                        </form>
                                        <a onclick="duplicate({{$event->id}})" class="dropdown-item"   data-toggle="tooltip" style="cursor:pointer">Duplicate</i></a>
                                      </div>
                                </div>
                                
                            </p>
                        </div>
    
                    </div>
                </div>
            </div>
    
    
        </div>
        </div>
       @endforeach

       @endif




        </div>
    </div>
</div>

@endsection
{{-- @include('sweet::alert') --}}
@push('after-scripts')
{{-- <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/places.js@1.14.0"></script>
<script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script> --}}

<script>

function duplicate(id) {
    var duplicate_url= $("#duplicate_url").val();
          var delay = 2000;
          $.ajax({
            url: duplicate_url,
            type:"POST",
            data: {"id":id,_token: "{{ csrf_token() }}"},
            success: function(data){
              swal("Success!", "Duplicate Completed", "success");
              setTimeout(function(){ window.location = data; }, delay);
            },
              error: function(msg) {
                swal("Oops...", "Something went wrong!", "error");
              }
          });
    }


    function destroyEvent(id) {
    var destroy_url= $("#destroy_url").val();
          var delay = 2000;
          $.ajax({
            url: destroy_url,
            type:"POST",
            data: {"id":id,_token: "{{ csrf_token() }}"},
            success: function(info){
              swal("Success!", "Event Deleted", "success");
              setTimeout(function(){ 
                  location.reload(); 
                  }, delay);
            },
              error: function(msg) {
                swal("Oops...", "Something went wrong!", "error");
              }
          });
    }

// $('.remove-interested-user').click(function() {
//         var remove_interested_url = $("#remove_interested_url").val(),
//             event_user_id = $(this).attr("data-event_user_id"),
//             delay = 2000;

        
//         if (confirm('Are you sure want to remove user')) {
//             $.ajax({
//         url: remove_interested_url,
//         type:"DELETE",
//         data: {"id":event_user_id, _token: "{{ csrf_token() }}", _method: 'DELETE'},
//         success: function(data){
//             alert("Success\n Interested volunteer remove from volunteer list");
//             // swal("Success!", "Interested volunteer assigned to volunteer list", "success");
//             setTimeout(function(){ location.reload(); }, delay);
//         },
//             error: function(msg) {
//             // swal("Oops...", "Something went wrong!", "error");
//             }
//         });
//         }    
        
// });



</script>



@endpush