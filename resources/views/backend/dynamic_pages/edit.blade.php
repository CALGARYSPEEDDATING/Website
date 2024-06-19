@extends('backend.layouts.app')

@push('after-styles')
@include('backend.events.includes.assets.styles')
@endpush
@section('title', app_name() . 'Edit | Dynamic Page ' )

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Edit Dynamic Page
                </h4>
            </div>
            <!--col-->
        </div>
        <!--row-->
        <form method="post" action="{{route('admin.update_dynamic_page')}}">
            @csrf
            <div class="form-group row">
                <label for="page_title" class="col-2 col-form-label">Page Title</label>
                <div class="col-9">
                    <input type="hidden" class="form-control" value="{{$dynamicPage->id}}" name="id" id="id"/>
                    <input type="text" class="form-control" value="{{$dynamicPage->page_title}}" name="page_title" id="page_title" required/>
                </div>
            </div>
            <div class="form-group row">
                <label for="description" class="col-2 col-form-label">Description</label>
                <div class="col-9">
                    <textarea class="form-control" name="description" id="description" rows="20" required>{{$dynamicPage->description}}</textarea>
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
      CKEDITOR.replace( 'description');
// var options = {
//     filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
//     filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
//     filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
//     filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}',

//     };

//     CKEDITOR.replace( 'description', options);


</script>
<script type="text/javascript">
        $(document).ready(function(){
            $('#event').on('change', function() {
                var query = $(this).val();
                $.ajax({
                    url:'{{ route("admin.email.getEventUser") }}',
                    type:'GET',
                    data:{'event':query},
                    success: function(data) {
                        debugger;
                        if(data){
                            $('#user_select').empty();
                            $('#user_select').focus;
                            $('#user_select').append('<option value="">-- Select User --</option>');
                            $.each(data, function(key, value){
                                debugger;
                                $('#user_select').append('<option value="'+ value.users.id +'">' + value.users.first_name + ' ' + value.users.last_name+ '</option>');
                            });
                      }else{
                        $('#user_select').empty();
                      }
                    }
                })
            });
            $('.multiple').select2({
                placeholder: "Select User",
                allowClear: true
            });
        });
    </script>
@endpush
