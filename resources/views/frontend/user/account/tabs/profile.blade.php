<div class="table-responsive">
    <form method="post" action="{{ route('frontend.user.profile.update')}}" enctype="multipart/form-data">
        @csrf
        <table class="table table-striped table-hover table-bordered">
            <tr>
                <button type="submit" class="btn btn-success float-right">Update</button>
            </tr>
            <tr>
                <th>@lang('labels.frontend.user.profile.avatar')
                    @if ($valid == 'yes')
                        @if ($user_auth_check)
                            <div data-countdown="{{$end}}" class="timer-count"></div>
                            <div><p style="color:green">Count down till your match results are automatically sent to you at 12 pm tomorrow.</p></div>
                        @endif
                    @endif
                </th>
                <td>
                <!-- <input type="radio" name="avatar_type" value="gravatar" {{ $logged_in_user->avatar_type == 'gravatar' ? 'checked' : '' }} /> Gravatar
                    <input type="radio" name="avatar_type" value="storage" {{ $logged_in_user->avatar_type == 'storage' ? 'checked' : '' }} /> Upload

                    @foreach($logged_in_user->providers as $provider)
                        @if(strlen($provider->avatar))
                            <input type="radio" name="avatar_type" value="{{ $provider->provider }}" {{ $logged_in_user->avatar_type == $provider->provider ? 'checked' : '' }} /> {{ ucfirst($provider->provider) }}
                        @endif
                    @endforeach -->
                    
                    <div class="form-group hidden" id="avatar_location">
                        {{ html()->file('avatar_location')->class('form-control') }}
                    </div><!--form-group-->
                    <br>
                    <img src="{{ $logged_in_user->picture }}" class="user-profile-image" width="150" height="150" /></td>
            </tr>
            <tr>
                <th>@lang('labels.frontend.user.profile.first_name')</th>
                <td><input value="{{ $logged_in_user->first_name }}" class="form-control" type="text" name="first_name" maxlength="191" required></td>
            </tr>
            <tr>
                <th>@lang('labels.frontend.user.profile.last_name')</th>
                <td><input value="{{ $logged_in_user->last_name }}" class="form-control" type="text" name="last_name" maxlength="191" required></td>
            </tr>
            <tr>
                <th>@lang('labels.frontend.user.profile.email')</th>
                <td><input value="{{ $logged_in_user->email }}" class="form-control" type="email" name="email" maxlength="191" required></td>
            </tr>
            <tr>
                <th>@lang('labels.frontend.user.profile.pincode')</th>
                <td><input value="{{ $logged_in_user->pincode }}" class="form-control" type="text" name="pincode" maxlength="6" minlength="6" required></td>
            </tr>
            <!-- <tr>
                <th>Interest</th>
                <td>
                    @php
                        if($logged_in_user->profile->profile)
                        {
                        echo $logged_in_user->profile->profile;
                        }
                        else
                        {
                            if($logged_in_user->profile->gender==0)
                            {
                    @endphp
                                <textarea  class="form-control" name="profile">{{ ($logged_in_user->profile->profile !='') ? $logged_in_user->profile->profile : 'international man of mystery.' }}</textarea>
                    @php
                            }
                            else
                            {
                    @endphp
                                <textarea  class="form-control" name="profile">{{ ($logged_in_user->profile->profile !='') ? $logged_in_user->profile->profile : 'international women of mystery.' }}</textarea>
                    @php    }
                        }
                    @endphp
                </td>
            </tr> -->
            <tr>
                <th colspan="2">
                    <p style="margin: 0 0 10px 0;color:red" >The profile questions are a set of questions you answer. Once you are at the event,
                    you will get a paper containing all the answered questions of all the ladies or men ( depending on your gender
                    who are coming to the event also.   It is a jumping-off point for conversation.
                    You are not selling yourself' or 'shopping for a commodity' as you might in an internet dating profile.
                    It is more general. Keep your answers short and in point form. It's about skimming, not reading.
                    Answer only the questions you want to answer. Please keep it to about 50 words.
                    If you choose not to create a Profile, your profile will read 'International Man/Woman of Mystery</p>
                </th>
            </tr>
            <tr id="questions">
                <th>What do you like to do when you're not working?</th>
                <td><textarea  class="form-control" name="question_one" maxlength="500">{{$logged_in_user->profile->question_one}}</textarea></td>
            </tr>
            <tr>
                <th>How would your best friend describe you?</th>
                <td><textarea  class="form-control" name="question_two" maxlength="500">{{$logged_in_user->profile->question_two}}</textarea></td>
            </tr>
            <tr>
                <th>What is your dream vacation?</th>
                <td><textarea  class="form-control" name="question_three" maxlength="500">{{$logged_in_user->profile->question_three}}</textarea></td>
            </tr>
            <tr>
                <th>What are you most passionate about?</th>
                <td><textarea  class="form-control" name="question_four" maxlength="500">{{$logged_in_user->profile->question_four}}</textarea></td>
            </tr>

            <tr>
                <th>Contact Info</th>
                <td><input value="{{ $logged_in_user->profile->matches_info }}" class="form-control" type="text" name="matches_info"></td>
            </tr>
            <tr>
                <th>Subscribe</th>
                <td><input type="checkbox" {{$logged_in_user->profile->subscribed != 0 ? 'checked' : '' }} class="form-check-input ml-2" name="subscribed" id="subscribed"> </td>
                <!-- {{ $logged_in_user->profile->subscribed ? 'Yes' : 'Not yet' }} -->
            </tr>
            <tr>
                <th>Show Image</th>
                <td><input type="checkbox" {{$logged_in_user->profile->show_image != 0 ? 'checked' : '' }} class="form-check-input ml-2" name="show_image" id="show_image"> </td>
                <!-- {{ $logged_in_user->profile->show_image ? 'Yes' : 'Not yet' }} -->
            </tr>
            <tr>
                <th>@lang('labels.frontend.user.profile.created_at')</th>
                <td>{{ timezone()->convertToLocal($logged_in_user->created_at) }} ({{ $logged_in_user->created_at->diffForHumans() }})</td>
            </tr>
            <tr>
                <th>@lang('labels.frontend.user.profile.last_updated')</th>
                <td>{{ timezone()->convertToLocal($logged_in_user->updated_at) }} ({{ $logged_in_user->updated_at->diffForHumans() }})</td>
            </tr>
        </table>

    </form>
</div>

@push('after-scripts')

<script src="{{asset('frontend/js/jquery.countdown.min.js')}}"></script>
<script>
    $('[data-countdown]').each(function() {
  var $this = $(this), finalDate = $(this).data('countdown');
  $this.countdown(finalDate, function(event) {
    if(event.strftime('%H:%M:%S') == "00:00:00"){
        $(this).data('countdown').hide();
    }
    $this.html(event.strftime('%H:%M:%S'));
  });
});
</script>
@endpush
