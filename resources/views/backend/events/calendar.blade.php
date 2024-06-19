@extends('backend.layouts.app')
<?php
$new_date = \Carbon\Carbon::now()->subDay(6)->toDateString();
?>
@push('after-styles')
{{--
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css" /> --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css" />
<style>
    .fc-event{
    cursor: pointer;
}
</style>
@endpush
@section('title', app_name() . ' | Calendar' )

@section('content')
<div class="row">
    <div class="col">
        
        <div class="container">
            {{-- <div class="row">
            <h2>Events</h2>

            <div class="btn-toolbar float-right" role="toolbar" aria-label="">
                <a href="{{ route('admin.auth.user.create') }}" class="btn btn-success ml-1" data-toggle="tooltip" title="Create Event"><i class="fas fa-plus-circle"></i></a>
            </div><!--btn-toolbar-->
            </div> --}}

            <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            Event Calendar <small class="text-muted">Approved Events</small>
                        </h4>
                    </div><!--col-->
        
                    <div class="col-sm-7">
                            <div class="btn-toolbar float-right" role="toolbar" aria-label="">
                                    <a href="{{ route('admin.event.create') }}" class="btn btn-success ml-1" data-toggle="tooltip" title="Create Event"><i class="fas fa-plus-circle"></i></a>
                                </div>
                    </div><!--col-->
                </div><!--row-->
            <br>
            {!! $calendar->calendar() !!}
            <br><br>
       

    </div>
    <!--col-->
    {{-- <div class="col">
            <div class="text-center">{{ $event_list->links() }}</div>
            </div>
        </div> --}}
        <div class="col-12">
       
    
                <div class="mx-auto" style="width: 200px;">{{ $event_list->links() }}</div>
                 </div>
            </div>
        
</div>


<!-- Modal -->
{{-- <div class="modal fade" id="fullCalModal" tabindex="-1" role="dialog" aria-labelledby="infoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modalTitle" class="modal-title" id="infoModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div id="modalBody" class="modal-body">
                <div class="container">
                <div class="row">
                    <div class="row">
                        <div class="col-sm-4">
                            <h3><strong>Date:</strong></h3>
                            <p id="date"></p>
                        </div>
                        <div class="col-sm-4">
                            <h3><strong>Time:</strong></h3>
                            <p id="time"></p>
                        </div>
                        <div class="col-sm-4">
                            <h3><strong>Address:</strong></h3>
                            <p id="address"></p>
                        </div>
                        <div class="col-sm-12 base-padding">
                            <h3><strong>Description:</strong></h3>
                            <p id="description"></p>
                        </div>
                    </div>
                </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a class="btn btn-primary" id="eventUrl" >Event Page</a>
            </div>
        </div>
    </div>
</div> --}}
{{-- End Modal --}}
@endsection
@push('after-scripts')
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
{!! $calendar->script() !!}
{{-- <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script> --}}
{{-- <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script> --}}
@endpush


