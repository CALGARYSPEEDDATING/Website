<span>Tags: </span>
@if (array_key_exists('status', $query)) 
@if($query['status'] == 0)   
<span class="badge badge-pill badge-warning">Pending</span> 
@elseif($query['status'] == 1)
<span class="badge badge-pill badge-success">Enables</span>
@elseif($query['status'] == 2)
<span class="badge badge-pill badge-danger">Cancelled</span>
@endif
@endif


@if(array_key_exists('time_period', $query))
@if($query['time_period'] == 'past') 
<span class="badge badge-pill badge-info">Past Events</span> 
@elseif($query['time_period'] == 'upcoming') 
<span class="badge badge-pill badge-info">Upcoming Events</span>
@elseif($query['time_period'] == 'today') 
<span class="badge badge-pill badge-info">Today Events</span> 
@endif 
@endif

@if(array_key_exists('date_posted', $query))
<span class="badge badge-pill badge-success">{{$query['date_posted']}}</span>  
@endif

@if(array_key_exists('keywords', $query))
<span class="badge badge-pill badge-success">{{$query['keywords']}}</span>  
@endif