<div class="table-responsive">
    <table class="table table-striped table-hover table-bordered">
        @if($user->profile->show_image)
        <tr>
            <th>@lang('labels.frontend.user.profile.avatar')</th>
            <td><img src="{{ $user->picture }}" class="user-profile-image" /></td>
        </tr>
        @endif
        <tr>
            <th>@lang('labels.frontend.user.profile.name')</th>
            <td>{{ $user->name }}</td>
        </tr>
        <tr>
            <th>@lang('labels.frontend.user.profile.email')</th>
            <td>{{ $user->email }}</td>
        </tr>
        <tr>
            <th>Interest</th>
            <td>
                @php
                    if($user->profile->profile)
                    {
                     echo $user->profile->profile;   
                    }
                    else
                    {
                        if($user->profile->gender==0)
                        {
                            echo 'international man of mystery';
                        }
                        else
                        {
                            echo 'international women of mystery';
                        }
                    }
                @endphp
            </td>
        </tr>
        <tr>
            <th>What do you like to do when you're not working?</th>
            <td>{{ $user->profile->question_one }}</td>
        </tr>
        <tr>
            <th>How would your best friend describe you?</th>
            <td>{{ $user->profile->question_two }}</td>
        </tr>
        <tr>
            <th>What is your dream vacation?</th>
            <td>{{ $user->profile->question_three }}</td>
        </tr>
        <tr>
            <th>What are you most passionate about?</th>
            <td>{{ $user->profile->question_four }}</td>
        </tr>

        <tr>
            <th>Contact Info</th>
            <td>{{ $user->profile->matches_info }}</td>
        </tr>
        <tr>
            <th>Alternate Phone</th>
            <td>{{ $user->profile->a_phone }}</td>
        </tr>
        @php
        $auth_user = $logged_in_user->profile;
        $comment =  \DB::table('matches')
                ->where('user_id', $logged_in_user->id)
                ->where('liked_user_id', $user->id)
                ->value('comment');
    @endphp
        <tr>
            <th><strong>Your Comments</strong></th>
            <td>
                {{$comment}}
            </td>
        </tr>
    </table>
    <form method="post" action="{{route('frontend.user.match.update')}}">
        @csrf
        <div class="form-group row">
            <label for="match_comment" class="col-2 col-form-label">Comments <i data-toggle="tooltip" data-placement="top" 
                title="Comments saved here are only viewable to you." 
                class="fa fa-question-circle tool-p-phone" aria-hidden="true"></i></label>
            <div class="col-9">
                <textarea class="form-control" name="match_comment" id="match_comment" rows="5">{{$comment}}</textarea>
            </div>
        </div>
        <input type="hidden" name="userid" value="{{$logged_in_user->id}}">
        <input type="hidden" name="matchid" value="{{$user->id}}">
        <div class="form-group row">
            <label for="submit" class="col-2 col-form-label"></label>
            <div class="col-9">
                <button type="submit" class="btn btn-success float-right">Save</button><br><br>
            </div>
        </div>
    </form>
</div>
