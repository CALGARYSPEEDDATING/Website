
<div class="row">
        <div class="col-md-6 col-sm-12">
        <p><strong>Male Count:</strong> {{$event->users()->where('gender', '=', 0)->where('wait_list','=', 1)->count()}}</p>
        </div>
        <div class="col-md-6 col-sm-12">
        <p><strong>Female Count:</strong> {{$event->users()->where('gender', '=', 1)->where('wait_list','=', 1)->count()}} </p>
         </div>
        <div class="col-md-12 ">
            <div class="">
                <table class="table table-hover table-responsive-sm">
                    <thead>
                        <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Register Date</th>
                                <th>Gender</th>
                                <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($wait_list as $wait_list_user)
                        <tr>

                                <td style="border-right: 1px solid #c8ced3;">{{$wait_list_user->full_name}}</td>
                                <td style="border-right: 1px solid #c8ced3;">{{$wait_list_user->email}}</td>
                                <td style="border-right: 1px solid #c8ced3;">{{
                                    timezone()->convertToLocal($wait_list_user->pivot->created_at) }}
                                </td>
                                
                                <td style="border-right: 1px solid #c8ced3;">
                                        {{$wait_list_user->profile->gender == 1 ? 'F' : 'M'}}  </td>
                               

                                
                                <td>
                                        <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                More
                                              </button>
                                              
                                              <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                    <a href="{{route('admin.auth.user.show', $wait_list_user->id)}}" style="cursor:pointer" class="dropdown-item" >View More</a>
                                                    <a href="{{route('admin.auth.user.edit', $wait_list_user->id)}}" style="cursor:pointer" class="dropdown-item" >Edit</a>
                                                    <a  data-name="{{$wait_list_user->full_name}}" data-event_id="{{$event->id}}" data-user_id="{{$wait_list_user->id}}" id="add-waitlist-user" style="cursor:pointer" class="dropdown-item" >Add to Registrants</a>
                                                    <a style="cursor:pointer"  data-name="{{$wait_list_user->full_name}}" data-event_id="{{$event->id}}" data-user_id="{{$wait_list_user->id}}" class="dropdown-item remove-user">Delete</a>
                                                    
                                              </div> 
                                </td>
                            </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
{{-- 
    <form action="#" method="POST">
            @csrf
            @method('DELETE')
            <button style="cursor:pointer" type="submit" class="dropdown-item" >Remove</button>
    </form> --}}