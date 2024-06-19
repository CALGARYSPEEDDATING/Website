@extends('backend.layouts.app')

@push('after-styles')
<script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>
@endpush
@section('title', app_name() . 'Dynamic Pages' )

@section('content')
<div class="row">
    <div class="col">
        <div class="container">
            <div class="row">
                <div class="col-sm-5 mb-4">
                    <h4 class="card-title mb-0">
                        <small class="text-muted">All Dynamic Pages</small>
                    </h4>
                </div><!--col-->

                <div class="col-sm-7">
                    <div class="btn-toolbar float-right" role="toolbar" aria-label="">
                        <a href="{{ route('admin.add_dynamic_page') }}" class="btn btn-success ml-1" data-toggle="tooltip" title="Create Page"><i class="fas fa-plus-circle"></i></a>
                    </div>
                </div><!--col-->
            </div><!--row-->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body no-border">
                            <table class="table table-hover table-responsive-sm">
                                <thead>
                                    <tr>
                                        <th>S#</th>
                                        <th>Page Title</th>
                                        <th>URL</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($dynamicPages as $key=>$dynamicPage)
                                    <tr>
                                        <td>{{$key=$key+1}}</td>
                                        <td>
                                            {{$dynamicPage->page_slug}}
                                        </td>
                                        <td>
                                            <a href="https://calgaryspeeddating.com/{{$dynamicPage->page_slug}}" target="_blank">https://calgaryspeeddating.com/{{$dynamicPage->page_slug}}</a>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group" aria-label="Actions">
                                                <a href="{{route('admin.edit_dynamic_page', $dynamicPage->id)}}" class="btn btn-primary"><i class="fa fa-edit" title="Edit"></i></a>
                                                <a href="{{route('admin.destroy_dynamic_page', $dynamicPage->id)}}" class="btn btn-danger"><i class="fas fa-trash" data-toggle="tooltip" data-placement="top" title="Delete"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
