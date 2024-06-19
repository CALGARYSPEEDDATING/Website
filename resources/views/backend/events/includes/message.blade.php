<form method="post" action="{{ route('admin.event.message', $event->id)}}">
        @csrf
        <div class="form-group row">
            <label class="col-md-2 form-control-label">Event Title</label>

            <div class="col-md-9">
           
            <input readonly="" class="form-control" value="{{$event->title}}" type="text" placeholder="Event Title"
                    maxlength="191" required="" autofocus="">
            </div>

            <!--col-->
        </div>
@php
  $templates = App\Models\PhoneTemplate::all();
@endphp
              <div class="form-group row">
                  <label class="col-md-2 form-control-label">Select Template</label>
                  <div class="col-md-9" required>
                   <select name="template" id="template" class="form-control">
                     @foreach ($templates as $template)
                        <option value="{{ $template->id }}">{{ $template->template_name }}</option>
                     @endforeach
                     
                   </select>
                  </div>
                  
                  <!--col-->
               </div>


         <div class="form-group row">
            <label class="col-md-2 form-control-label">Gender</label>
            <div class="col-md-9" required>
             <select name="gender" id="gender" class="form-control">
                <option value ="" disabled="">Chose Gender</option>
                <option value="0">Male</option>
                <option value="1">Female</option>
             </select>
            </div>
            
            <!--col-->
         </div>

        <div class="form-group row">
            <label for="" class="col-2 col-form-label">Age Range</label>
            <div class="col-9">
                <input required data-from="18" data-to="80" value="" type="text" name="age_range" class="women_age_slider js-range-slider form-control age_range" />
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-2 form-control-label" for="company">To</label>
            <div class="col-md-9">
             <select multiple name="users[]" id="users" class="form-control" required>
                {{-- <option value="all">All</option> --}}
              {{--  @php
                   $users  = DB::table('users')->select('users.id', 'users.first_name','users.last_name')->join('event_user', 'users.id', 'event_user.user_id')->get();
               @endphp
               @if (isset($users) && count($users) > 0)
                @foreach ($users as $user)
                     <option value="{{ $user->id }}">{{ ucfirst($user->first_name) }} {{ ucfirst($user->last_name) }}</option>
                @endforeach
               @endif --}}
             </select>
            </div>
        </div>
         <div class="form-group row">
            <label for="" class="col-2 col-form-label">Text Message</label>
            <div class="col-9">
                 <textarea class="form-control"id="message" required name="message"></textarea>
            </div>
        </div>

             <div class="form-group row">
            <label for="message" class="col-2 col-form-label"></label>
            <div class="col-9">
                <button type="submit" class="btn btn-success float-right">Send message</button><br><br>

            </div>
        </div>
</form>
 @push('after-scripts')

<script type="text/javascript">
    $(document).ready(function(){
        $('.age_range').on('change',function(){
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
             type:'get',
             url: "{{ route('admin.event.getUserWithinRang') }}",
             data: {age_range:$(this).val(),gender:$('#gender').val()},
              success: function(response)
              {
                html= '';
                $('#users').empty('');
                   $.each(response,function(key, val) {
                      console.log('user_id',val.user_id);
                      html+= '<option value = '+val.user_id+'>'+val.first_name+' '+val.last_name+'</option>';
                    });
                   $('#users').append(html);
                   console.log(html);

              },
            error: function(jqXHR,error, errorThrown) {  
                if(jqXHR.status&&jqXHR.status==400){
                     swal({
                      title: "Failed",
                       text: jqXHR.responseText,
                      icon: "danger",
                      button: "Ok",
                    });
                 
                   console.log(jqXHR.responseText)
                }else{
                    swal({
                      title: "Failed",
                       text: 'Something went wrong needs to debug',
                      icon: "danger",
                      button: "Ok",
                    });
                 
                     console.log('Something went wrong needs to debug')
                  return false;
                }
            }
      });
        });
    });
</script>
@endpush