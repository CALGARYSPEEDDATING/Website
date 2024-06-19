@extends('backend.layouts.app')

@section('title', __('labels.backend.access.users.management') . ' | ' . __('labels.backend.access.users.create'))

@section('breadcrumb-links')
@include('backend.auth.user.includes.breadcrumb-links')
@endsection

@section('content')
{{ html()->form('POST', route('admin.auth.user.store'))->class('form-horizontal')->open() }}
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    @lang('labels.backend.access.users.management')
                    <small class="text-muted">@lang('labels.backend.access.users.create')</small>
                </h4>
            </div>
            <!--col-->
        </div>
        <!--row-->

        <hr>

        <div class="row mt-4 mb-4">
            <div class="col">
                <div class="form-group row">
                    {{ html()->label(__('validation.attributes.backend.access.users.first_name'))->class('col-md-2
                    form-control-label')->for('first_name') }}

                    <div class="col-md-10">
                        {{ html()->text('first_name')
                        ->class('form-control')
                        ->placeholder(__('validation.attributes.backend.access.users.first_name'))
                        ->attribute('maxlength', 191)
                        ->required()
                        ->autofocus() }}
                    </div>
                    <!--col-->
                </div>
                <!--form-group-->

                <div class="form-group row">
                    {{ html()->label(__('validation.attributes.backend.access.users.last_name'))->class('col-md-2
                    form-control-label')->for('last_name') }}

                    <div class="col-md-10">
                        {{ html()->text('last_name')
                        ->class('form-control')
                        ->placeholder(__('validation.attributes.backend.access.users.last_name'))
                        ->attribute('maxlength', 191)
                        ->required() }}
                    </div>
                    <!--col-->
                </div>
                <!--form-group-->

                <div class="form-group row">
                    {{ html()->label(__('validation.attributes.backend.access.users.email'))->class('col-md-2
                    form-control-label')->for('email') }}

                    <div class="col-md-10">
                        {{ html()->email('email')
                        ->class('form-control')
                        ->placeholder(__('validation.attributes.backend.access.users.email'))
                        ->attribute('maxlength', 191)
                        ->required() }}
                    </div>
                    <!--col-->
                </div>
                <!--form-group-->

                <div class="form-group row">
                    {{ html()->label(__('validation.attributes.backend.access.users.password'))->class('col-md-2
                    form-control-label')->for('password') }}

                    <div class="col-md-10">
                        {{ html()->password('password')
                        ->class('form-control')
                        ->placeholder(__('validation.attributes.backend.access.users.password'))
                        ->required() }}
                    </div>
                    <!--col-->
                </div>
                <!--form-group-->

                <div class="form-group row">
                    {{
                    html()->label(__('validation.attributes.backend.access.users.password_confirmation'))->class('col-md-2
                    form-control-label')->for('password_confirmation') }}

                    <div class="col-md-10">
                        {{ html()->password('password_confirmation')
                        ->class('form-control')
                        ->placeholder(__('validation.attributes.backend.access.users.password_confirmation'))
                        ->required() }}
                    </div>
                    <!--col-->
                </div>
                <!--form-group-->

                {{-- Additional Fields --}}
                <div class="form-group row">
                    <label class="col-md-2 form-control-label" for="company">Date of Birth</label>

                    <div class="col-md-10">
                    <input class="form-control" value="{{old('dob')}}" type="text" name="dob" id="dob" placeholder="M/DD/YYYY"
                            maxlength="191" required="" autofocus="">
                    </div>
                    <!--col-->
                </div>

                <div class="form-group row">
                    <label class="col-md-2 form-control-label" for="company">Gender</label>

                    <div class="col-md-10">

                        <select name="gender" id="gender" class="form-control">
                            <option alue="">Chose Gender</option>
                            <option {{old('gender') == 0 ? 'selected' : ''}} value="0">Male</option>
                            <option {{old('gender') == 1 ? 'selected' : ''}} value="1">Female</option>
                        </select>
                    </div>
                    <!--col-->
                </div>

                <div class="form-group row">
                    <label class="col-md-2 form-control-label" for="phone">Primary Phone</label>

                    <div class="col-md-10">
                        <input class="form-control" value="{{old('phone')}}" type="text" name="phone" id="phone" placeholder="Primary Phone"
                            maxlength="191" autofocus="">
                    </div>
                    <!--col-->
                </div>

                <div class="form-group row">
                    <label class="col-md-2 form-control-label" for="a_phone">Alternate Phone</label>

                    <div class="col-md-10">
                        <input class="form-control" value="{{old('a_phone')}}" type="text" name="a_phone" id="a_phone" placeholder="Alternate Phone"
                            maxlength="191" autofocus="">
                    </div>
                    <!--col-->
                </div>

                <div class="form-group row">
                    <label class="col-md-2 form-control-label" for="contact_info">Contact Information for Matches</label>

                    <div class="col-md-10">
                        <input class="form-control" value="{{old('contact_info')}}" type="contact_info" name="contact_info" id="contact_info"
                            placeholder="Contact Information for Matches" maxlength="191" autofocus="">
                    </div>
                    <!--col-->
                </div>

                <div class="form-group row">
                    <label class="col-md-2 form-control-label" for="about_us">Where did you hear Calgary Speed Dating</label>

                    <div class="col-md-10">
                        <input class="form-control" value="{{old('about_us')}}" type="input" name="about_us" id="about_us" placeholder="Where did you hear Calgary Speed Dating"
                            maxlength="191" autofocus="">
                    </div>
                    <!--col-->
                </div>

                {{--End Additional Fields --}}



                <div class="form-group row">
                    {{ html()->label(__('validation.attributes.backend.access.users.active'))->class('col-md-2
                    form-control-label')->for('active') }}

                    <div class="col-md-10">
                        <label class="switch switch-label switch-pill switch-primary">
                            {{ html()->checkbox('active', true, '1')->class('switch-input') }}
                            <span class="switch-slider" data-checked="yes" data-unchecked="no"></span>
                        </label>
                    </div>
                    <!--col-->
                </div>
                <!--form-group-->

                <div class="form-group row">
                    {{ html()->label(__('validation.attributes.backend.access.users.confirmed'))->class('col-md-2
                    form-control-label')->for('confirmed') }}

                    <div class="col-md-10">
                        <label class="switch switch-label switch-pill switch-primary">
                            {{ html()->checkbox('confirmed', true, '1')->class('switch-input') }}
                            <span class="switch-slider" data-checked="yes" data-unchecked="no"></span>
                        </label>
                    </div>
                    <!--col-->
                </div>
                <!--form-group-->

                @if(! config('access.users.requires_approval'))
                <div class="form-group row">
                    {{ html()->label(__('validation.attributes.backend.access.users.send_confirmation_email') . '<br />'
                    . '<small>' . __('strings.backend.access.users.if_confirmed_off') . '</small>')->class('col-md-2
                    form-control-label')->for('confirmation_email') }}

                    <div class="col-md-10">
                        <label class="switch switch-label switch-pill switch-primary">
                            {{ html()->checkbox('confirmation_email', true, '1')->class('switch-input') }}
                            <span class="switch-slider" data-checked="yes" data-unchecked="no"></span>
                        </label>
                    </div>
                    <!--col-->
                </div>
                <!--form-group-->
                @endif

                <div class="form-group row">
                    {{ html()->label(__('labels.backend.access.users.table.abilities'))->class('col-md-2
                    form-control-label') }}

                    <div class="col-md-10">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>@lang('labels.backend.access.users.table.roles')</th>
                                        <th>@lang('labels.backend.access.users.table.permissions')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            @if($roles->count())
                                            @foreach($roles as $role)
                                            <div class="card">
                                                <div class="card-header">
                                                    <div class="checkbox d-flex align-items-center">
                                                        {{ html()->label(
                                                        html()->checkbox('roles[]', old('roles') &&
                                                        in_array($role->name, old('roles')) ? true : false,
                                                        $role->name)
                                                        ->class('switch-input')
                                                        ->id('role-'.$role->id)
                                                        . '<span class="switch-slider" data-checked="on" data-unchecked="off"></span>')
                                                        ->class('switch switch-label switch-pill switch-primary mr-2')
                                                        ->for('role-'.$role->id) }}
                                                        {{ html()->label(ucwords($role->name))->for('role-'.$role->id)
                                                        }}
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    @if($role->id != 1)
                                                    @if($role->permissions->count())
                                                    @foreach($role->permissions as $permission)
                                                    <i class="fas fa-dot-circle"></i> {{ ucwords($permission->name) }}
                                                    @endforeach
                                                    @else
                                                    @lang('labels.general.none')
                                                    @endif
                                                    @else
                                                    @lang('labels.backend.access.users.all_permissions')
                                                    @endif
                                                </div>
                                            </div>
                                            <!--card-->
                                            @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            @if($permissions->count())
                                            @foreach($permissions as $permission)
                                            <div class="checkbox d-flex align-items-center">
                                                {{ html()->label(
                                                html()->checkbox('permissions[]', old('permissions') &&
                                                in_array($permission->name, old('permissions')) ? true : false,
                                                $permission->name)
                                                ->class('switch-input')
                                                ->id('permission-'.$permission->id)
                                                . '<span class="switch-slider" data-checked="on" data-unchecked="off"></span>')
                                                ->class('switch switch-label switch-pill switch-primary mr-2')
                                                ->for('permission-'.$permission->id) }}
                                                {{
                                                html()->label(ucwords($permission->name))->for('permission-'.$permission->id)
                                                }}
                                            </div>
                                            @endforeach
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!--col-->
                </div>
                <!--form-group-->
            </div>
            <!--col-->
        </div>
        <!--row-->
    </div>
    <!--card-body-->

    <div class="card-footer clearfix">
        <div class="row">
            <div class="col">
                {{ form_cancel(route('admin.auth.user.index'), __('buttons.general.cancel')) }}
            </div>
            <!--col-->

            <div class="col text-right">
                {{ form_submit(__('buttons.general.crud.create')) }}
            </div>
            <!--col-->
        </div>
        <!--row-->
    </div>
    <!--card-footer-->
</div>
<!--card-->
{{ html()->form()->close() }}
@endsection
