<form method="post" action="{{ route('admin.event.matches', $event->id)}}">
        @csrf
        <input type="hidden" name="event_id" value="{{ $event->id }}">
        <div class="form-group row">
          <label class="col-md-2 form-control-label">User</label>
          <div class="col-md-9" required>
           <select required name="user_id" id="user_id" class="form-control">
              <option disabled>Select User</option>
               @php
                 $users  =  \DB::table('users')
                                  ->select('users.id', 'users.first_name', 'users.last_name', 'event_user.gender as gender')
                                  ->join('event_user','event_user.user_id','users.id')
                                  ->where('event_user.event_id',$event->id)
                                  ->where('event_user.wait_list',0)
                                  ->orderBy('event_user.gender', 'desc')
                                  ->get();
             @endphp
             @isset ($users)
              @foreach ($users as $user)
                  <option value="{{ $user->id  }}">{{ ucfirst($user->first_name).' '.ucfirst($user->last_name)  }} 
                    ({{$user->gender ? 'F' : 'M'}})</option>
              @endforeach           
             @endisset
              
           </select>
          </div>
          <!--col-->
      </div>

        <div class="form-group row">
            <label class="col-md-2 form-control-label">Likes</label>
            <div class="col-md-9" required>
             <select required name="liked_user_id[]" id="liked_user_id" class="form-control form-control-lg" multiple>
                <option disabled >Likes Users</option>
                 @php
                   $likes =  \DB::table('users')
                                    ->select('users.id', 'users.first_name', 'users.last_name', 'event_user.gender as gender')
                                    ->join('event_user','event_user.user_id','users.id')
                                    ->where('event_user.wait_list',0)
                                    ->where('event_user.event_id',$event->id)
                                    ->orderBy('event_user.gender', 'desc')
                                    ->get();
               @endphp
               @isset ($likes)
                @foreach ($likes as $liked)
                    <option value="{{ $liked->id  }}">{{ ucfirst($liked->first_name).' '.ucfirst($liked->last_name)  }}
                      ({{$liked->gender ? 'F' : 'M'}})</option>
                @endforeach           
               @endisset
             </select>
            </div>
            
            <!--col-->
        </div>
          <div class="form-group row">
            <label for="comment" class="col-2 col-form-label">User Comment</label>
            <div class="col-9">
                 <textarea class="form-control"id="comment" name="comment"></textarea>
            </div>
        </div>

        <div class="form-group row">
            <label for="message" class="col-2 col-form-label"></label>
            <div class="col-9">
                <button type="submit" class="btn btn-success float-right">Save</button><br><br>

            </div>
        </div>
</form>