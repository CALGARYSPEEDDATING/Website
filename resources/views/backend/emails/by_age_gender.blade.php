@extends('backend.layouts.app')

@push('after-styles')
@include('backend.events.includes.assets.styles')
@endpush
@section('title', app_name() . 'Email | By Age and Gender ' )

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Email By Age and Gender
                </h4>
            </div>
            <!--col-->
        </div>
        <!--row-->



        <!-- <form method="post" action="{{route('admin.email.by-age-gender')}}"> -->
    <form method="post" action="{{route('admin.email.by-age-gender')}}">
            @csrf
            {{-- <div class="form-group">
                <div class="row">
                    <label for="datetimes" class="col-md-2 col-form-label">Age From &amp; To</label>

                    <div class="col-md-4 ">
                        <div class="form-group">
                                <select class="form-control " id="type" name="type">
                                        <option value="">Select From</option>
                                        @for($i = 20; $i <= 85; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor

                                    </select>
                        </div>
                    </div>
                    <div class="col-md-4 offset-md-1">
                        <div class="form-group">

                            <div class="form-group">
                                    <select class="form-control " id="type" name="type">
                                        <option value="">Select To</option>
                                        @for($i = 20; $i <= 85; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                        </select>
                            </div>
                        </div>
                    </div>


                </div>
            </div> --}}

           
        <div class="form-group row">
                    <label for="users_age" class="col-2 col-form-label">Age Range</label>
                    <div class="col-9">
                        <input type="text" name="user_age_range" id="users_age" class=" js-range-slider form-control" required/>
                    </div>
            </div>
            <div class="form-group row">
                <label for="select_event" class="col-2 col-form-label">Event</label>
                <div class="col-9">
                    <select class="form-control " id="select_event" name="event_id" required>
                        <option value="">Select Event</option>
                        @foreach($events as $event)
                        <option value="{{$event->id}}">{{$event->title}} #{{$event->id}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                    <div class="row">
                        <label for="gender" class="col-md-2 col-form-label">Gender</label>
    
                        <div class="col-md-9 ">
                            <div class="form-group">
                                    <select class="form-control " id="gender" name="gender" required>
                                            <option value="">Select Gender</option>
                                            <option value="0">Male</option>
                                            <option value="1">Female</option>
                                        </select>
                            </div>
                        </div>
                      
    
    
                    </div>
                </div>

                <div class="form-group row">
                        <label for="description" class="col-2 col-form-label">Email</label>
                        <div class="col-9">
                            <textarea class="form-control" name="description" id="description" rows="5" required></textarea>
        
                        </div>
                    </div>








            {{-- <div class="form-group row">
                <label for="description" class="col-2 col-form-label">Email Body</label>
                <div class="col-9">
                    <textarea class="form-control" name="description" id="description" rows="5"></textarea>

                </div>
            </div> --}}

            <div class="form-group row">
                <label for="submit" class="col-2 col-form-label"></label>
                <div class="col-9">
                    <button type="submit" class="btn btn-success float-right">Submit</button><br><br>

                </div>
            </div>

        </form>
    </div>
    <!--card-body-->

    <div class="card-footer">
        <div class="row">
            <div class="col">
                <small class="float-left text-muted">
                    <strong></strong>
                </small>
            </div>
            <!--col-->
            <div class="col text-right">
                <a class="btn btn-warning" href="">Back</a>
            </div>
        </div>
        <!--row-->
    </div>
    <!--card-footer-->
</div>
<!--card-->

@endsection

@push('after-scripts')
@include('backend.events.includes.assets.scripts')
<script>
      CKEDITOR.replace( 'description');
// var options = {
//     filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
//     filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
//     filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
//     filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}',
  
//     };
    
//     CKEDITOR.replace( 'description', options);

    $(".js-range-slider").ionRangeSlider({
       type: "double",
       min: 18,
       max: 80,
       from: 18,
       to: 80,
       grid: true,
       skin: "round",
       onChange: function (data) {
        // $("#female_age_from").val(data.from);
        // $("#female_age_to").val(data.to);  
        }
   });
   
</script>
@endpush
