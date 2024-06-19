<div class="col">
    <div class="table-responsive">
        <table class="table table-hover">
            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.avatar')</th>
                <td><img src="{{ $user->picture }}" class="user-profile-image" /></td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.name')</th>
                <td>{{ $user->name }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.email')</th>
                <td>{{ $user->email }}</td>
            </tr>

            <tr>
                    <th>Date of Birth</th>
                    <td>{{ date("F j, Y", strtotime($user->dob)) }}</td>
            </tr>

            <tr>
                    <th>Phone</th>
                    <td>{{ $user->phone }}</td>
            </tr>

            <tr>
                    <th>Gender</th>
                    <td>{{ $user->profile->gender == 1 ? 'Female' : 'Male' }}</td>
            </tr>
            <tr>
                    <th>Contact info for matches</th>
                    <td>{{ !empty($user->profile->matches_info) ? $user->profile->matches_info : 'None Provided'}}</td>
            </tr>
            <tr>
                    <th>Interest</th>
                    <td>{{ !empty($user->profile->profile) ? $user->profile->profile : 'None Provided'}}</td>
            </tr>
            <tr>
                    <th>Alternate Phone</th>
                    <td>{{ !empty($user->profile->a_phone) ? $user->profile->a_phone : 'None Provided'}}</td>
            </tr>

            <tr>
                    <th>Heard about us</th>
                    <td>{{ $user->profile->about_us}}</td>
            </tr>
            <tr>
                    <th>Subscribe</th>
                    <td>{{ $user->profile->subscribe ? 'Yes' : 'Not Yet'}}</td>
            </tr>
             <tr>
                    <th>Ban</th>
                    <td>{!! $user->isBanned() ? '<a href="'.route('admin.auth.user.ban',['user'=>$user->id, 'ban'=>0]).'"><span class="badge badge-info">Unbann?</span></a>' : '<a href='.route('admin.auth.user.ban',['user'=>$user->id, 'ban'=>1]).'><span class="badge badge-danger Ban">Ban?</span></a>'!!}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.status')</th>
                <td>{!! $user->status_label !!}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.confirmed')</th>
                <td>{!! $user->confirmed_label !!}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.timezone')</th>
                <td>{{ $user->timezone }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.last_login_at')</th>
                <td>
                    @if($user->last_login_at)
                        {{ timezone()->convertToLocal($user->last_login_at) }}
                    @else
                        N/A
                    @endif
                </td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.last_login_ip')</th>
                <td>{{ $user->last_login_ip ?? 'N/A' }}</td>
            </tr>
        </table>
    </div>
</div><!--table-responsive-->
