@extends('backend.layouts.app')

@push('after-styles')
@include('backend.events.includes.assets.styles')
@endpush
@section('title', app_name() . 'Event View ' )
<style>
.blinking{
    animation:blinkingText 1.2s infinite;
}
@keyframes blinkingText{
    0%{     color: red;    }
    49%{    color: red; }
    60%{    color: transparent; }
    99%{    color:transparent;  }
    100%{   color: red;    }
}
</style>
@section('content')
<form method="post" action="{{route('admin.event.add.user', $event->id)}}">
    @csrf
    <div class="form-group row">
        <label class="col-md-2 col-form-label" for="category"><strong>Add Users</strong></label>
        <div class="col-md-9">
            <select class="form-control form-control-lg users" id="user_id" name="user_id[]" multiple>
                <option value="0">Select User</option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-md-2 col-form-label" for="category"><strong></strong></label>
        <div class="col-md-9">
            <div class="form-check form-check-inline">
                <input class="form-check-input" name="paid_user" type="checkbox" id="paid-user" value="1">
                <label class="form-check-label" for="paid-user">Paid</label>
            </div>
        </div>
    </div>


    {{-- <input type="hidden" name="main_event_id"  value="{{$event->id}}"> --}}
    <div class="form-group row">
        <label for="description" class="col-2 col-form-label"></label>
        <div class="col-9">
            <button type="submit" class="btn btn-success float-right">Add</button><br><br>

        </div>
    </div>

</form>
{{-- <select  class="form-control form-control-lg users" id="user_id" name="user_id[]" multiple>
    <option value="">Select User</option>
@foreach($users as $users)
    <option value="{{$users->id}}">{{$users->first_name}} {{$users->last_name}}</option>
@endforeach
</select> --}}
<div class="row">
    <div class="col-12">
        <span id="submit-text" class="text-center blinking" style="display:none"><h4>"Now Click Submit Matches"</h4></span>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <nav aria-label="...">
            <ul class="pagination">
                @if($previous)
                <li class="page-item ">
                    <a class="page-link" href="{{route('admin.event.show', $previous)}}">Previous</a>
                </li>
                @endif
                @if($next)
                <li class="page-item">
                    <a class="page-link" href="{{route('admin.event.show', $next)}}">Next</a>
                </li>
                @endif
            </ul>

        </nav>
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{-- {{ $event->title }} --}}
                    <small class="text-muted">Event Management</small>
                </h4>
            </div>
            <div class="col-sm-7">
                @include('backend.auth.user.includes.header-buttons')
                <div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.export')">

                    <!-- <a href="{{ route('admin.event.complete-matches', $event->id) }}" class="btn btn-success ml-1"
                        data-toggle="tooltip" title="@lang('labels.general.export')"><i
                            class="fas fa-heart"></i>Matches Completed</a> -->


                    <a href="{{ route('admin.event.registrants-pdf', $event->id) }}" class="btn btn-success ml-1"
                        data-toggle="tooltip" title="@lang('labels.general.export')"><i
                            class="fas fa-file-pdf"></i>Export Registrants</a>

                    <a href="{{ route('admin.event.registrants-interest', $event->id) }}" class="btn btn-success ml-1"
                                data-toggle="tooltip" title="Export Interest"><i
                                    class="fas fa-file-pdf"></i>Export Interest</a>

                    <a href="{{ route('admin.event.email-tracking', $event->id) }}" class="btn btn-warning ml-1"
                                data-toggle="tooltip" title="Email Tracking"><i
                                    class="fas fa-envelope"></i>Email Tracking</a>

                </div>
                <!--btn-toolbar-->

            </div>
            <!--col-->
            <!--col-->
        </div>
        <!--row-->

        <div class="row mt-4 mb-4">
            <div class="col">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active session_tab_view" data-toggle="tab" href="#overview" role="tab"
                            aria-controls="overview" aria-expanded="true"><i class="far fa-calendar-alt"></i> View</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#desc" role="tab" aria-controls="desc"
                            aria-expanded="true"><i class="fas fa-users"></i> Description</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#edit" role="tab" aria-controls="overview"
                            aria-expanded="true"><i class="far fa-edit"></i> Edit</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#registrants" role="tab" aria-controls="overview"
                            aria-expanded="true"><i class="fas fa-briefcase"></i> Registrants</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#interested" role="tab" aria-controls="interested"
                            aria-expanded="true"><i class="fas fa-users"></i> Wait List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#message" role="tab" aria-controls="message"
                            aria-expanded="true"><i class="fas fa-envelope"></i> Messaging</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link bg-green text-white session_tab_matches" data-toggle="tab" href="#matches" role="tab" aria-controls="matches"
                            aria-expanded="true"><i class="fas fa-users"></i> User Matches</a>
                    </li>

                    {{-- @if($volunteers->count())@endif --}}

                    {{-- <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#add_user" role="tab" aria-controls="add_user"
                                aria-expanded="true"><i class="fas fa-users"></i> Reports</a>
                        </li> --}}
                    {{-- Add volunteers
                        Interested Volunteers --}}

                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="overview" role="tabpanel" aria-expanded="true">
                        @include('backend.events.includes.view')
                    </div>
                    <!--tab-->
                    <div class="tab-pane fade" id="desc" role="tabpanel" aria-expanded="true">
                        @include('backend.events.includes.description')
                    </div>
                    <!--tab-->
                    <div class="tab-pane fade" id="edit" role="tabpanel" aria-expanded="true">
                        @include('backend.events.includes.edit')
                    </div>
                    <!--tab-->
                    <div class="tab-pane fade" id="registrants" role="tabpanel" aria-expanded="true">
                        @include('backend.events.includes.registrants')

                    </div>
                    <!--tab-->

                    <div class="tab-pane fade" id="interested" role="tabpanel" aria-expanded="true">

                        @include('backend.events.includes.wait_list')

                    </div>
                    <div class="tab-pane fade" id="message" role="tabpanel" aria-expanded="true">

                        @include('backend.events.includes.message')

                    </div>
                    <div class="tab-pane fade" id="matches" role="tabpanel" aria-expanded="true">

                        @include('backend.events.includes.matches')

                    </div>
                    <!--tab-->

                    <div class="tab-pane fade" id="add_user" role="tabpanel" aria-expanded="true">

                        {{-- <form method="post" action="{{ route('admin.event.add.volunteer') }}">
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label" for="category"><strong>Users</strong></label>
                            <div class="col-md-9">
                                <select class="form-control form-control-lg" id="user_id" name="user_id">
                                    <option value="">Select User</option>
                                    @foreach($users as $users)
                                    <option value="{{$users->id}}">{{$users->first_name}} {{$users->last_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="age_range_to" id="age_range_to">
                        <input type="hidden" name="age_range_from" id="age_range_from">
                        <input type="hidden" name="main_event_id" value="{{$event->id}}">
                        <div class="form-group row">
                            <label for="description" class="col-2 col-form-label"></label>
                            <div class="col-9">
                                <button type="submit" class="btn btn-success float-right">Add</button><br><br>

                            </div>
                        </div>
                        </form> --}}
                    </div>
                    <!--tab-->
                </div>
                <!--tab-content-->

            </div>
            <!--col-->
        </div>
        <!--row-->
    </div>
    <!--card-body-->

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        {{-- <div class="modal-dialog" role="document">
                <form method="post" action="{{ route('admin.event.confirm-user-hours') }}">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Approved Hours</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="datetimes" class="col-md-12 col-form-label">Hours</label>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="input-group date" id="end_date">

                                                <input name="user_hours" id="user_hours" type="text"
                                                    class="form-control" />
                                                <div class="input-group-append">
                                                    <div class="input-group-text"><i class="fas fa-clock"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="event_user_id" name="event_user_id">
                                <div class="col-md-6">
                                    <label for="datetimes" class="col-md-12 col-form-label">Minutes</label>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="input-group date" id="end_date">

                                                <input name="user_mins" id="user_mins" value="" type="text"
                                                    class="form-control " />
                                                <div class="input-group-append">
                                                    <div class="input-group-text"><i class="fas fa-clock"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!--form-group-->
                    </div>
                    <!--col-->
                </div>
                <!--row-->

            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                <button class="btn btn-primary" type="submit">Save changes</button>
            </div>
        </div>
        </form>
    </div> --}}

</div>



<div class="card-footer">
    <div class="row">
        <div class="col">
            <small class="float-left text-muted">
                <strong>@lang('labels.backend.access.users.tabs.content.overview.created_at'):</strong> {{
                        timezone()->convertToLocal($event->created_at) }} ({{ $event->created_at->diffForHumans() }})

            </small>
        </div>
        <!--col-->
        <div class="col text-right">
            <a class="btn btn-warning" href="\">Back</a>
        </div>
    </div>
    <!--row-->
</div>
<!--card-footer-->
</div>
<!--card-->

<input type="hidden" name="delete_url" id="delete_url" value="{{ route('admin.event.delete')}}">
<input type="hidden" name="add_registrant_url" id="add_registrant_url"
    value="{{ route('admin.event.add.registrants')}}">
<input type="hidden" name="get_user_url" id="get_user_url" value="{{route('admin.event.add.users')}}">
<input type="hidden" name="status_url" id="status_url" value="{{ route('admin.event.approve')}}">
<input type="hidden" name="check_user_url" id="check_user_url" value="{{ route('admin.event.user_checked')}}">

@endsection
@push('after-scripts')
@include('backend.events.includes.assets.scripts')

<script>
    var get_user_url = $("#get_user_url").val();
$(document).ready(function(){
        var db_session ="{{ Session::get('db_session') }}";
        var matches_session ="{{ Session::get('matches_session') }}";
        if(db_session){
            $(".submit-hide").hide();
            $(".submit-show").show();
            $('#overview').attr('class', 'tab-pane fade');
            $('#submit-text').show();
            $('#matches').attr('class', 'tab-pane active show');
            var removeDbSession="{{Session::forget('db_session')}}";
            $('.session_tab_view').attr('class', 'nav-link session_tab_view')
            $('.session_tab_matches').attr('class', 'nav-link active bg-green text-white session_tab_matches')

        }
        if(matches_session){
            $('#overview').attr('class', 'tab-pane fade');
            $('#submit-text').hide();
            $('#matches').attr('class', 'tab-pane active show');
            var removeDbSession="{{Session::forget('matches_session')}}";
            $('.session_tab_view').attr('class', 'nav-link session_tab_view')
            $('.session_tab_matches').attr('class', 'nav-link active bg-green text-white session_tab_matches')
        }
        $('#disable-click').click(function(event){
            debugger;
            if ($('#disable-click').attr('disabled','true'))
            {
                swal.fire("Click On Save To Database First");
            }
        });
    $('#user_id').select2({
        placeholder: "Look up user by First or Last name",
        allowClear: true,
        ajax: {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        url: get_user_url,
        type: "post",
        dataType: 'json',
        delay: 250,
        data: function (params) {
            return {
            searchTerm: params.term // search term
            };
        },
   processResults: function (response) {
     return {
        results: response
     };
   },
   cache: true
  }
    });
    $('#liked_user_id').select2({
        width: '100%'
    });
    // $(".users").chosen({});

    (function() {
 var placesAutocomplete = places({
   appId: 'plW1BEH6EDNL',
   apiKey: '615e03b2ac995b93a451642711fb8510',
   container: document.querySelector('#address')
    }).configure({
    countries: ['ca']
    });
    })();

$('#lfm').filemanager('image');
if(window.location.hash != "") {
    $('a[href="' + window.location.hash + '"]').click()
}

});
$(".women_age_slider").ionRangeSlider({
    type: "double",
       min: 18,
       max: 80,
       grid: true,
       skin: "round",
       onChange: function (data) {
        $("#female_age_from").val(data.from);
        $("#female_age_to").val(data.to);
        }
});
$(".men_age_slider").ionRangeSlider({
    type: "double",
       min: 18,
       max: 80,
       grid: true,
       skin: "round",
       onChange: function (data) {
        $("#male_age_to").val(data.to);
        $("#male_age_from").val(data.from);
        }
});

var options = {
    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
    };

CKEDITOR.replace( 'description', options);


    function set_status(value,id) {
    var status_url = $("#status_url").val();
          var delay = 2000;

          $.ajax({
            url: status_url,
            type:"POST",
            data: {"id":id,"value":value,_token: "{{ csrf_token() }}"},
            success: function(data){
            //   swal("Success!", "Status Set", "success");
              setTimeout(function(){ location.reload(); }, delay);
            },
              error: function(msg) {
                swal("Oops...", "Something went wrong!", "error");
              }
          });
    }

    //


    var dateNow = new Date();
    // var dw = "{{date('m/d/y h:i:s', strtotime($event->start_time))}} ";
    var sd = "{{date('m/d/y', strtotime($event->start_datetime))}} ",
        st = '{{ date("g:i a", strtotime($event->start_datetime)) }}',
        ed = "{{date('m/d/y', strtotime($event->end_datetime))}} ",
        et = '{{ date("g:i a", strtotime($event->end_datetime)) }}';

    // date("g:i a", strtotime("13:30"));

     //    Edit Start and End Date
     var dateNow = new Date();
    $(function () {


    $('#edit_start_date').datetimepicker({
        defaultDate: moment(sd, 'MM/DD/YYYY'),
        format: 'MM/DD/YYYY'
    });





    $('#edit_start_time').datetimepicker({
        defaultDate: moment(st, 'LT'),
        format: 'LT'
    });

    $('#edit_end_date').datetimepicker({
        defaultDate: moment(ed, 'MM/DD/YYYY'),
        format: 'MM/DD/YYYY'
    });

    $('#edit_end_time').datetimepicker({
        defaultDate: moment(et, 'LT'),
        format: 'LT'
    });

    $("#edit_start_date").on("change.datetimepicker", function (e) {
    $('#edit_end_date').datetimepicker('minDate', e.date);
    });
    $("#edit_end_date").on("change.datetimepicker", function (e) {
    $('#edit_start_date').datetimepicker('maxDate', e.date);
    });

    $("#edit_start_time").on("change.datetimepicker", function (e) {
    $('#edit_end_time').datetimepicker('minDate', e.date);
    });
    $("#edit_end_time").on("change.datetimepicker", function (e) {
    $('#edit_start_time').datetimepicker('maxDate', e.date);
    });



});

// New Dynamic Delete

$(document).ready(function() {
      $(".remove-user").click(function(e){
        e.preventDefault();
        var delete_url = $("#delete_url").val();
        var id = $(this).data("user_id");
        var name = $(this).data("name");
        var event_id = $(this).data("event_id");
        var delay = 2000;
        swal.fire({
        title: 'Are you sure?',
        text: 'User ' +name+ ' will be deleted from the event',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, keep it'
        }).then((result) => {
        if (result.value) {
            $.ajax({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
          url: delete_url,
          type: 'POST',
          dataType: "JSON",
          data: {"id":id,"event_id":event_id, "_method": 'delete'},
          success: function () {
            swal.fire(
            'Deleted!',
            'User '  + name + ' deleted',
            'success'
            );
            setTimeout(function(){ location.reload(); }, delay);
          },
          error: function(msg) {
            swal.fire(
                "Oops...",
                "Something went wrong!",
                "error"
                );
          }
        });
        } else if (result.dismiss === swal.DismissReason.cancel) {
            swal.fire(
            'Cancelled',
            'User ' + name + ' will not be deleted',
            'error'
            )
        }
        })

      });



      $("#add-waitlist-user").click(function(e){
        e.preventDefault();
        var add_registrant_url = $("#add_registrant_url").val();
        var id = $(this).data("user_id");
        var name = $(this).data("name");
        var event_id = $(this).data("event_id");
        var delay = 2000;
        swal.fire({
        title: 'Are you sure?',
        text: 'User ' +name+ ' will be added to the registrant list',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Confirm',
        cancelButtonText: 'Cancel'
        }).then((result) => {
        if (result.value) {
        $.ajax({
        headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
          url: add_registrant_url,
          type: 'POST',
          data: {"id":id,"event_id":event_id},
          success: function () {
            swal.fire(
            'Added!',
            'User '  + name + ' has been added to registrants',
            'success'
            );
            setTimeout(function(){ location.reload(); }, delay);
          },
          error: function(msg) {
            swal.fire(
                "Oops...",
                "Something went wrong!",
                "error"
                );
          }
        });
        } else if (result.dismiss === swal.DismissReason.cancel) {
            swal.fire(
            'Cancelled',
            'User ' + name + ' will not be added to the registrants list',
            'error'
            )
        }
        })

      });



      // AJax
       // $('#check_user').change(function() {
        //     if ($(this).is(':checked')) {
        //         $('#ambulance_staging').attr("disabled", false);
        //         $('#ambulance_pickup_time').prop('readonly',false);
        //         $('#ambulance_dropoff_time').prop('readonly',false);
        //     } else {
        //         $('#ambulance_staging').attr("disabled", true);
        //         $('#ambulance_pickup_time').prop('readonly',true);
        //         $('#ambulance_dropoff_time').prop('readonly',true);

        //     }
        // });




    });
</script>
@endpush
