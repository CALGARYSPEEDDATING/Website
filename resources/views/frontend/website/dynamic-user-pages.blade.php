@extends('frontend.layouts.app')

@section('title', app_name() . 'Extra Pages' )

@section('content')
<div class="row">
    <div class="col">
        <div class="container">
            <div class="row">
                <div class="col-sm-5 mb-4">
                    <h4 class="card-title mb-0">All Extra Pages</h4>
                </div><!--col-->
            </div><!--row-->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body no-border">
                            <table class="table table-hover table-responsive-sm">
                                <thead>
                                    <tr>
                                        <th>Page Title</th>
                                        <th>URL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($dynamicPages as $key=>$dynamicPage)
                                    <tr>
                                        <td>
                                            {{$dynamicPage->page_title}}
                                        </td>
                                        <td>
                                            <a href="https://calgaryspeeddating.com/{{$dynamicPage->page_slug}}" target="_blank">https://calgaryspeeddating.com/{{$dynamicPage->page_slug}}</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>							
                            {{ $dynamicPages->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
