@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.users.management'))

@section('breadcrumb-links')
    @include('backend.auth.user.includes.breadcrumb-links')
@endsection
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
   
<script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
 <script src = "https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer ></script>

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('labels.backend.access.users.management') }} <small class="text-muted">{{ __('labels.backend.access.users.active') }}</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.auth.user.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                          <th>@lang('labels.backend.access.users.table.first_name')</th>
                          <th>@lang('labels.backend.access.users.table.last_name')</th>
                          <th>@lang('labels.backend.access.users.table.email')</th>
                          {{--  <th>@lang('labels.backend.access.users.table.confirmed')</th>
                            <th>@lang('labels.backend.access.users.table.roles')</th>
                            <th>@lang('labels.backend.access.users.table.other_permissions')</th> --}}
                          <th>@lang('labels.backend.access.users.table.dob')</th>
                          <th>@lang('labels.backend.access.users.table.phone')</th>
                          <th>@lang('labels.backend.access.users.table.last_login_at')</th>
                          <th>@lang('labels.backend.access.users.table.about_us')</th>
                          <th>@lang('labels.backend.access.users.table.gender')</th>
                          {{-- <th>@lang('labels.backend.access.users.table.profile')</th> --}}
                            {{-- <th>@lang('labels.backend.access.users.table.social')</th> --}}
                          <th>@lang('labels.backend.access.users.table.last_updated')</th>
                          <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
        <div class="row">
           {{--  <div class="col-7">
                <div class="float-left">
                    {!! $users->total() !!} {{ trans_choice('labels.backend.access.users.table.total', $users->total()) }}
                </div>
            </div> --}}
            <!--col-->

           {{--  <div class="col-5">
                <div class="float-right">
                    {!! $users->render() !!}
                </div>
            </div><!--col--> --}}
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
<style type="text/css">
  /*
 * Colour dictionary:
 *
 * Table control elements:   #719ba7
 * Header cells:             #66A9BD
 * Body header cells:        #91c5d4
 * Body content cells:       #d5eaf0
 * Body content cells (alt): #bcd9e1
 * Footer header:            #b0cc7f
 * Footer content:           #d7e1c5
 */


/*
 * Page setup styles
 */



/*
 * DataTables framework
 */


div.dataTables_length {
  float: left;
}

div.dataTables_filter {
  float: right;
}

div.dataTables_info {
  padding: 9px 6px 6px 6px;
  float: left;
}

div.dataTables_paginate {
  float: right;
}

div.dataTables_length,
div.dataTables_filter,
div.dataTables_paginate {
  padding: 6px;
}

/* Self clearing - http://www.webtoolkit.info/css-clearfix.html */
.dataTables_wrapper:after {
  content: ".";
  display: block;
  clear: both;
  visibility: hidden;
  line-height: 0;
  height: 0;
}



/*
 * Pagination
 */
a.paginate_button,
a.paginate_active {
  display: inline-block;
  /*background-color: #608995;*/
  padding: 2px 6px;
  margin-left: 2px;
  cursor: pointer;
  *cursor: hand;
}

a.paginate_active {
  background-color: transparent;
  border: 1px solid black;
}

a.paginate_button_disabled {
  color: #3d6672;
}
.paging_full_numbers a:active {
  outline: none
}
.paging_full_numbers a:hover {
  text-decoration: none;
}

div.dataTables_paginate span>a {
  width: 30px;
  text-align: center;
}



</style>
 <script type="text/javascript">
            jQuery( document ).ready( function( $ ) {
          
                jQuery('.table').DataTable({
                 processing: true,
                 serverSide: true,
                  "pagingType": "full_numbers",
                 ajax: {
                  url: "{{route('admin.auth.user.userajax')}}",
                  type: 'post',
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                },
                columns: [
                    {data: 'first_name', name: 'first_name'},
                    {data: 'last_name', name: 'last_name'},
                    {data: 'email', name: 'email'},
                    {data: 'dob', name: 'dob'},
                    {data: 'phone', name: 'phone'},
                    {data: 'last_login_at', name: 'last_login_at'},
                    {data: 'profile.about_us', name: 'profile.about_us'},
                    {data: 'profile.gender', name: 'profile.gender'},
                    {data: 'updated_at', name: 'updated_at', orderable: false, searchable: false}, 
                    // {data: 'action_buttons', name: 'action_buttons'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                  ],
                order: [[1, 'asc']]
              });
            });
          </script>

@endsection
