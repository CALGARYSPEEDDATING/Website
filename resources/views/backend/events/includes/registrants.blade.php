@php

$remaining_men = ($event->limit - $event->users()->where('gender', '=', 0)->where('wait_list','=', 0)->count());
$remaining_women = ($event->f_limit - $event->users()->where('gender', '=', 1)->where('wait_list','=', 0)->count());

@endphp

<div class="row">
    <div class="col-md-6 col-sm-12">
        <p><strong>Male Count: </strong>{{$event->users()->where('gender', '=', 0)->where('wait_list','=',
            0)->count()}} <strong>Remaining:</strong> {{$remaining_men}} <strong>Paid:</strong> {{$event->users()->where('gender',
            '=', 0)->where('wait_list','=', 0)->where('paid','=', 1)->count()}} </p>
    </div>
    <div class="col-md-6 col-sm-12">
        <p><strong>Female Count: </strong> {{$event->users()->where('gender', '=', 1)->where('wait_list','=',
            0)->count()}} <strong>Remaining:</strong> {{$remaining_women}} <strong>Paid:</strong> {{$event->users()->where('gender',
            '=', 1)->where('wait_list','=', 0)->where('paid','=', 1)->count()}}</p>
    </div>
    <div class="col-md-12">
        <div class="">
            <table class="table table-hover table-responsive-sm">
                <thead>
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Register Date</th>
                        <th>Gender</th>
                        <th>Paid</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($registrants as $registrant)
                    {{-- onchange="checkUser({{$registrant->id}})" --}}

                    <tr>
                        <td style="border-right: 1px solid #c8ced3;">
                            {{-- <label class="switch switch-label switch-pill switch-primary">
                                        {{ html()->checkbox('active', true, '1')->class('switch-input') }}
                            <span class="switch-slider" data-checked="yes" data-unchecked="no"></span>
                            </label> --}}

                            <label class="switch switch-label switch-pill switch-primary">
                                <input {{$registrant->pivot->checked ? 'checked' : ''}} data-event_id="{{$event->id}}"
                                    data-user_id="{{$registrant->id}}" class="switch-input" type="checkbox"
                                    data-id="{{$registrant->pivot->id}}" id="check_user-{{$registrant->pivot->id}}"
                                    name="checked" value="1">


                                <span class="switch-slider" data-checked="yes" data-unchecked="no"></span>
                            </label>

                            {{-- <div class="checkbox d-flex align-items-center">
                        <div class="toggle"> --}}
                            {{-- <input type="radio" name="ambulance_requested" {{$event->office->ambulance_requested == 1 ? "checked" : ""}}
                            value="1" id="ambulance_requested_yes" /> --}}
                            {{-- <input type="radio" name="user_checked"  value="1" id="user_checked_yes" />
                            <label for="ambulance_requested_yes">Yes</label>
                            <input type="radio" name="user_checked"  value="0" id="user_checked_no" />
                            <label for="user_checked_no">No</label>
                        </div>

                    </div>
                                         --}}




                        </td>
                        <td style="border-right: 1px solid #c8ced3;">{{$registrant->full_name}}</td>
                        <td style="border-right: 1px solid #c8ced3;">{{$registrant->email}}</td>
                        <td style="border-right: 1px solid #c8ced3;">{{
                            timezone()->convertToLocal($registrant->pivot->created_at) }}
                        </td>

                        <td style="border-right: 1px solid #c8ced3;">
                            {{$registrant->profile->gender == 1 ? 'F' : 'M'}} </td>

                        <td style="border-right: 1px solid #c8ced3;">{{$registrant->pivot->paid == 1
                            ? 'Yes' : 'No'}} </td>

                        <td>

                            <div class="btn-group btn-group-sm" role="group" aria-label="Volunteer Actions">
                                <a href="{{route('admin.auth.user.show', $registrant->id)}}" class="btn btn-info"><i
                                        class="fas fa-eye" title="View Users"></i></a>
                                <a href="{{route('admin.auth.user.edit', $registrant->id)}}" class="btn btn-primary"><i
                                        class="fa fa-edit" title="View Users"></i></a>
                                <a data-name="{{$registrant->full_name}}" data-event_id="{{$event->id}}"
                                    data-user_id="{{$registrant->id}}" class="btn btn-danger remove-user"><i
                                        class="fas fa-trash" data-toggle="tooltip" data-placement="top"
                                        title="Delete"></i></a>
                            </div>
                        </td>
                    </tr>
                    @push('after-scripts')
                    <script>
                        $("#check_user-{{$registrant->pivot->id}}").on("change", function () {
                            var check_user_url = $("#check_user_url").val();
                            var val = $(this).val();
                            var user_id = $(this).data("user_id");
                            var event_id = $(this).data("event_id");
                            var id = $(this).data("id");
                            var set = $(this).is(':checked') ? 1 : 0;
                            var delay = 2000;
                            $.ajax({
                                url: check_user_url,
                                type: "POST",
                                data: {
                                    "id": id,
                                    "event_id": event_id,
                                    "user_id": user_id,
                                    "value": set,
                                    _token: "{{ csrf_token() }}"
                                },
                                success: function (data) {
                                    swal("Success!", "User updated", "success");
                                    //   setTimeout(function(){ location.reload(); }, delay);
                                },
                                error: function (msg) {
                                    swal("Oops...", "Something went wrong!", "error");
                                }
                            });
                        });

                    </script>
                    @endpush

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
