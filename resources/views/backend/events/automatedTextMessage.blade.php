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
                    Automated text message to be sent to event attendees
                </h4>
            </div>
            <!--col-->
        </div>
        <!--row-->

    <form method="post" action="{{route('admin.message.savetemplate')}}">
            @csrf
           
     
            <div class="form-group row">
                <label for="select_event" class="col-2 col-form-label">Event</label>
                <div class="col-9">
                    <select required="" class="form-control " id="select_event" name="event_type" required>
                        <option selected="" disabled="" value="">Select Event Type</option>
                     <option>matches</option>
                     <option>pre-event</option>
                     <option>post-event</option>
                    </select>
                </div>
            </div>

                 <div class="form-group row">
                        <label for="template_name" class="col-2 col-form-label">Template Name</label>
                        <div class="col-9">
                         <input type="text" name="template_name" class="form-control" id="template_name">
        
                        </div>
                    </div>

                      <div class="form-group row">
                        <label for="message_body" class="col-2 col-form-label">Message Body</label>
                        <div class="col-9">
                            <textarea class="form-control" name="message_body" id="message_body" rows="5" required></textarea>
        
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
      CKEDITOR.replace( 'message_body');
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
