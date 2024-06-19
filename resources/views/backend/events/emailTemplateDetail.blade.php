@extends('backend.layouts.app')

@push('after-styles')
@include('backend.events.includes.assets.styles')
@endpush
@section('title', app_name() . 'Email Template Detail ' )

@section('content')
<div class="text-center">
    <h4 class="card-title mb-3">{{$emailTemplates->title}} Template</h4> 
</div>
<div class="card">
    <div class="card-body">

    <form method="post" action="{{route('admin.message.saveEmailTemplate')}}">
            @csrf
            <div class="form-group row">
                <div class="col-9">
                    <input type="hidden" value="{{$emailTemplates->id}}" name="id" class="form-control"/>
                </div>
            </div>

                      <div class="form-group row">
                        <label for="message_body" class="col-2 col-form-label">Message Body</label>
                        <div class="col-9">
                            <textarea class="form-control" name="description" id="message_body" rows="5" required>{!!$emailTemplates->description!!}</textarea>
        
                        </div>
                    </div>

            <div class="form-group row">
                <label for="submit" class="col-2 col-form-label"></label>
                <div class="col-9">
                    <button type="submit" class="btn btn-success float-right">Update</button><br><br>

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
