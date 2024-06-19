<div class="row">
    {{-- <div class="col-md-1">
        @if($event->created_at >= $new_date)
        <span class="green">New</span>
          @endif
        
         <span class="green">{{ date("d", strtotime($event->start_time)) }}<sup>th</sup> {{ date("M",
            strtotime($event->start_time)) }} {{ date("y", strtotime($event->start_time)) }}</span>
    </div> --}}
    <div class="col-md-12 mb-3">
        <div class="list-group list-group-ov">
            <div class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                    <h4 class="mb-1">{{ $event->title }} #{{$event->id}}</h4>
                    <small class="text-muted">Created: {{$event->created_at->diffForHumans()}} </small>
                </div>

                <div class="row">
                    <div class="col-sm border-right">
                        <p class="in-block"><i class="far fa-clock"></i><span> {{ date("l",
                                strtotime($event->start_datetime)) }}</span> {{
                            date("g:i a", strtotime($event->start_datetime)) }} - {{ date("g:i a",
                            strtotime($event->end_datetime)) }} <br>
                        <i class="fas fa-calendar-alt"></i> <span>  {{ date('F j, Y', strtotime($event->end_datetime)) }}    
                        </p>


                    </div>
                    <div class="col-sm border-right">

                            <a target="_blank" href="http://maps.google.com/?q= {{ $event->address }}"><p class="in-block"><i class="fa fa-map-marker" aria-hidden="true"></i>
                            {{ $event->address }}</p></a>
                             
                    </div>
                    <input type="hidden" id="duplicate_url" name="duplicate_url" value="{{route('admin.event.duplicate', [$event->id])}}">
                    <div class="col-sm ">
                        <p class="in-block">
                            <div class="btn-group" role="group" aria-label="Basic example">
                            <a href="{{route('admin.event.show', $event->id)}}" data-toggle="tooltip" data-placement="top" title="Show" class="btn btn-info"><i class="fas fa-eye"></i></a>

                            <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    More
                                  </button>
                                  
                                  <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                  {{-- <form action="{{route('admin.event.destroy', $event->id)}}" method="POST">
                                            @csrf
                                          
                                            
                                    </form>  --}}
                                    <input type="hidden" id="destroy_url" name="destroy_url" value="{{route('admin.event.destroy', $event->id)}}">
                                    <button onclick="destroyEvent({{$event->id}})"  style="cursor:pointer" type="submit" class="dropdown-item" >Delete</button>
                                    <a onclick="duplicate({{$event->id}})" class="dropdown-item"   data-toggle="tooltip" style="cursor:pointer">Duplicate</i></a>
                                  </div>
                            </div>
                            
                        </p>
                    </div>

                </div>
            </div>
        </div>


    </div>
</div>