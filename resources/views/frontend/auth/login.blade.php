@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))

@section('content')

<section id="registration" class="main_padding">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="signup_container">
                        {{-- {{ html()->form('POST', )->open() }} --}}
                        <form method="POST" action="{{route('frontend.auth.login.post')}}" id="signin-form" class="signup-form">

                            @csrf
                            <div class="form-group mb-4">
                                    {{ html()->label(__('validation.attributes.frontend.email'))->for('email') }}

                                    {{ html()->email('email')
                                        ->attribute('maxlength', 191)
                                        ->required() }}
                                {{-- <label for="signin_email" class="form-label required">Email</label>
                                <input type="text" name="email" id="email" required> --}}
                            </div>
                            <div class="form-group">
                                    {{ html()->label(__('validation.attributes.frontend.password'))->for('password') }}

                                    {{ html()->password('password')
                                     
                                        ->required() }}
                                {{-- <label for="first_name" class="form-label required">Password</label>
                                <input type="password" 
                                name="password" id="password" placeholder="Password" required="" 
                                autocomplete="off" id="password" required> --}}
                                
                            </div>

                            {{-- {{ html()->password('password')
                            ->class('form-control')
                            ->placeholder(__('validation.attributes.frontend.password'))
                            ->required() }}
                            --}}

                            <div class="form-group ">
                                <a href="{{ route('frontend.auth.password.reset') }}" class="font-weight-bold">
                                    <p>Reset Password</p>
                                </a>
                            </div>
                            <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <div class="checkbox">
                                                {{ html()->label(html()->checkbox('remember', true, 1) . ' ' . __('labels.frontend.auth.remember_me'))->for('remember') }}
                                            </div>
                                        </div><!--form-group-->
                                    </div><!--col-->
                                </div><!--row-->
                            <div class="text-center mt-5">
                                <button type="submit" class="contact100-form-btn btn btn-theme">
                                    LOGIN
                                </button>
                            </div>
                        </form>
                            {{-- {{ html()->form()->close() }} --}}
                            <div class="row">
                                    <div class="col">
                                        <div class="text-center">
                                            {!! $socialiteLinks !!}
                                        </div>
                                    </div><!--col-->
                                </div><!--row-->
                        {{-- </form> --}}
                        <div class="text-center pb-5">
                            <h6>New Member? <a href="{{route('frontend.auth.register')}}" class="font-weight-bold">Click To Register</a></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured -->
    <section id="featured_events" class="pt-5 pb-5 bg-grey">
            @include('frontend.includes.featured') 
    </section>
@endsection