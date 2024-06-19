@extends('backend.layouts.app')

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
   
<script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
 <script src = "https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer ></script>

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                          <th>@lang('labels.backend.access.users.table.first_name')</th>
                          <th>@lang('labels.backend.access.users.table.last_name')</th>
                          <th>@lang('labels.backend.access.users.table.email')</th>
                          <th>@lang('labels.backend.access.users.table.gender')</th>
                          <th>@lang('labels.backend.access.users.table.status')</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($email_trackings as $email_tracking)
                                <tr>
                                    <td>{{$email_tracking->user->first_name}}</td>
                                    <td>{{$email_tracking->user->last_name}}</td>
                                    <td>{{$email_tracking->user->email}}</td>
                                    <td>{{$email_tracking->user->profile->gender ==  1 ? "F" : "M"}}</td>
                                    <td>{{$email_tracking->status == 1 ? "Sent" : "Not-Sent"}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
        <div class="row">
            <!--col-->

        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
<style type="text/css">
  
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

@endsection
