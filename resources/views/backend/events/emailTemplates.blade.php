@extends('backend.layouts.app')

@push('after-styles')
@include('backend.events.includes.assets.styles')
@endpush
@section('title', app_name() . 'Email Templates ' )

@section('content')
<div class="text-center">
    <h4 class="card-title mb-0">Templates</h4>
</div>
    <div class="container">
        <div class="row mt-4">
            @foreach ($emailTemplates as $emailTemplate)
                <div class="col-3 mt-2">
                    <div class="card-group">
                            <div class="card">
                                <div class="card-body">
                                    <a href="{{route('admin.message.emailTemplateDetail', ['id' => $emailTemplate->id])}}">
                                        <h5 class="card-title">{{$emailTemplate->title}}</h5>
                                    </a>
                                <!-- <p class="card-text">{!!$emailTemplate->description!!}</p> -->
                                </div>
                            </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection

@push('after-scripts')
@include('backend.events.includes.assets.scripts')
<script>
      CKEDITOR.replace( 'message_body');
</script>
@endpush
