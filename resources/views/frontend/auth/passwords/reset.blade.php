@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))

@section('content')

<section id="registration" class="main_padding">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="signup_container">
                            @if(session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                    
                        {{-- {{ html()->form('POST', )->open() }} --}}
                        <form method="POST" action="{{route('frontend.auth.password.reset')}}" id="signin-form" class="signup-form">
                                {{ html()->hidden('token', $token) }}
                                {{-- {{ html()->hidden('token', $token) }} --}}
                            @csrf
                            <div class="form-group mb-4">
                                
                                    {{ html()->label(__('validation.attributes.frontend.email'))->for('email') }}

                                    {{ html()->email('email')
                                   
                                        ->placeholder(__('validation.attributes.frontend.email'))
                                        ->attribute('maxlength', 191)
                                        ->required() }}
                                {{-- <label for="signin_email" class="form-label required">Email</label>
                                <input type="text" name="email" id="email" required> --}}
                            </div>

                      
                            <div class="form-group">
                                {{ html()->label(__('validation.attributes.frontend.password'))->for('password') }}

                                {{ html()->password('password')
                                  
                                    ->placeholder(__('validation.attributes.frontend.password'))
                                    ->required() }}
                            </div><!--form-group-->

                            <div class="form-group">
                                    {{ html()->label(__('validation.attributes.frontend.password_confirmation'))->for('password_confirmation') }}
                                    {{ html()->password('password_confirmation')
                                        ->placeholder(__('validation.attributes.frontend.password_confirmation'))
                                        ->required() }}
                                </div><!--form-group-->
                

                            <div class="text-center mt-5">
                                <button type="submit" class="contact100-form-btn btn btn-theme">
                                    Reset Password
                                </button>
                            </div>
                        </form>
                            {{-- {{ html()->form()->close() }} --}}
                            <div class="row">
                                    <div class="col">
                                        <div class="text-center">
                                          
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