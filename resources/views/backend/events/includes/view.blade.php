<div class="row">
    <div class="col-md-8">
        <div class="table-responsive">
            <table class="table table-hover">
                <tr>
                    <th>Title</th>
                    <td style="border-right: 1px solid #c8ced3;"> {{ $event->title}} #{{$event->id}}</td>
                </tr>

                <th>Start Date and Time</th>
                <td style="border-right: 1px solid #c8ced3;">{{ date("F j, Y", strtotime($event->start_datetime)) }} at
                    {{date("g:i a",
                    strtotime($event->start_datetime))}}

                    <a download="event.ics" href="{{$ics_link}}"><i class="far fa-calendar-plus"></i><small>
                            Outlook/Apple</small></a>
                    <a target="_blank" download="event.ics" href="{{$google_link}}"><i class="far fa-calendar-plus"></i><small>
                            Google</small></a>

                </td>
                </tr>

                <tr>
                    <th>End Date and Time</th>
                    <td style="border-right: 1px solid #c8ced3;">{{ date("F j, Y", strtotime($event->end_datetime)) }}
                        at
                        {{date("g:i a", strtotime($event->end_datetime))}}</td>
                </tr>

                <tr>
                    <th>Address</th>
                    <td style="border-right: 1px solid #c8ced3;"> <a target="_blank" href="http://maps.google.com/?q= {{ $event->address }}"><i
                                class="fa fa-map-marker" aria-hidden="true"></i> {{ $event->address }}
                            </p></a></td>
                </tr>
                
                <tr>
                    <th>Type</th>
                    <td style="border-right: 1px solid #c8ced3;"> 
                    @if ($event->type == 1)
                      Female Only
                    @elseif ($event->type == 2)
                      Men Only
                    @else
                      Standard
                    @endif
                    
                    </td>
                </tr>
                <tr>
                    <th>Male Limit</th>
                    <td style="border-right: 1px solid #c8ced3;"> {{ $event->limit}} </td>
                </tr>
                <tr>
                    <th>Female Limit</th>
                    <td style="border-right: 1px solid #c8ced3;"> {{ $event->f_limit}} </td>
                </tr>
                <tr>
                    {{-- {{ $event->age_range}} --}}
                    <th>Men Age Rage</th>
                    <td style="border-right: 1px solid #c8ced3;">
                        {{$event->details->male_age_from }}To
                        {{$event->details->male_age_to }}
                    </td>
                </tr>
                <tr>
                    {{-- {{ $event->age_range}} --}}
                    <th>Women Age Rage</th>
                    <td style="border-right: 1px solid #c8ced3;">
                        {{$event->details->female_age_from }} To
                        {{$event->details->female_age_to }}
                    </td>
                </tr>

                <tr>
                    <th>Men Price</th>
                    <td style="border-right: 1px solid #c8ced3;"> $ {{ $event->price_male}} </td>
                </tr>

                <tr>
                    <th>Women Price</th>
                    <td style="border-right: 1px solid #c8ced3;"> $ {{ $event->price_female}} </td>
                </tr>

                <tr>
                    <th>Duration</th>
                    <td style="border-right: 1px solid #c8ced3;"> {{$duration }} </td>
                </tr>
                {{-- <tr>
                    <th>Description</th>
                    <div class="col-md-6">
                    <td style="border-right: 1px solid #c8ced3;"> {!! $event->description !!}</td>
                    </div>
                </tr> --}}

            </table>
        </div>
    </div>
    <div class="col-md-4">

        <div class="row">
            <label class="col-md-3 col-form-label"><strong>Status</strong></label>
            <div class="col-md-9">
                @switch($event->status)
                @case(1)
                <span id="status-success" class="badge badge-pill badge-success">Enabled</span>
                @break
                @case(2)
                <span id="status-disabled" class="badge badge-pill badge-danger">Disabled</span>
                @break
                @case(3)
                <span id="status-admin" class="badge badge-pill badge-info">Admin Only</span>
                @break
                @case(4)
                <span id="status-admin" class="badge badge-pill badge-danger">Cancelled</span>
                @break
                @default
                <span id="status-warning" class="badge badge-pill badge-warning">Pending</span>
                @endswitch

            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 col-form-label" for="status"><strong></strong></label>
            <div class="col-md-9">
                <select class="form-control form-control-lg" onChange="set_status(this.value,{{$event->id}});" id="status"
                    name="status">
                    <option value="0">Select Status</option>
                    {{-- @if($event->status != 1)

                    @else
                    @endif --}}
                    <option value="0" {{ $event->status == 0 ? "selected" : ""}}>Pending</option>
                    <option value="1" {{ $event->status == 1 ? "selected" : ""}}>Enable</option>
                    <option value="2" {{ $event->status == 2 ? "selected" : ""}}>Disable</option>
                    <option value="3" {{ $event->status == 3 ? "selected" : ""}}>Admin Only</option>
                    <option value="4" {{ $event->status == 4 ? "selected" : ""}}>Cancel</option>
                </select>
            </div>
        </div>
        <div class="form-group row">

                <img src="{{$event->main_image}}" alt="Event image" width="445px" height="250px">
        </div>
        <div class="form-group row">
              
                        <label class="col-md-12 col-form-label"><strong>Notes</strong></label>
                        <div class="col-md-12">
                                {{$event->notes}}
                        </div>
            
            
        </div>
    </div>
</div>
