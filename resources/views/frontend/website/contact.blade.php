@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.frontend.contact.box_title'))

@section('content')
<section id="contact-page" class="main_padding">
        <div class="container-contact100 container">
            <div class="row">
                
                <div class="col-lg-8">
                    <div class="wrap-contact100">
                     <form method="POST" action="{{route('frontend.contact.send')}}" class="contact100-form validate-form">
                            @csrf
                            {{-- {{ html()->class('form-control')->form('POST', route('frontend.contact.send'))->open() }} --}}
                            <span class="contact100-form-title">
                                Get in Touch
                            </span>
                            <div class="wrap-input100 rs1-wrap-input100 validate-input" data-validate="Name is required">
                                <span class="label-input100">Enter Your Name *</span>
                            <input class="input100" value="{{optional(auth()->user())->name}}" type="text" name="name" placeholder="Enter your name">
                            </div>
                            <div class="wrap-input100 rs1-wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                                <span class="label-input100">Enter your email *</span>
                                <input class="input100" value="{{optional(auth()->user())->email}}"  type="text" name="email" placeholder="Enter your email">
                            </div>

                            <div class="wrap-input100 validate-input" data-validate="Message is required">
                                <span class="label-input100">Message</span>
                                <textarea cols="80" class="input100" name="message" placeholder="Your message here..."></textarea>
                            </div>

                            <div class="wrap-input100 validate-input" data-validate="Message is required">
                                    {!! Captcha::display() !!}
                                    {{ html()->hidden('captcha_status', 'true') }}
                            </div>
                     

                            <div class="container-contact100-form-btn">
                                <div class="wrap-contact100-form-btn">

                                    <button class="contact100-form-btn btn btn-theme">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </form>
                            {{-- {{ html()->form()->close() }} --}}
                     

                    </div>
                </div>



                <div class="col-lg-4">
                    <span class="contact100-form-title">
                        Information
                    </span>
                    <h4>
                        Calgary Speed Dating
                    </h4>
                    <p>
                    </p>
                    <p><a href="tel:4032193283">(403) 219-3283</a></p>
                    <p><a href="mailto:info@calgaryspeeddating.com?Subject=Hello%20">Email Me</a></p>
                    
                    {{-- <hr>
                    <h4>
                        Heading
                    </h4>
                    <p>Lorem Ipsum is simply dummy text of the printing and

                    </p>
                    <hr>
                    <h4>
                        Heading
                    </h4>
                    <p>Lorem Ipsum is simply dummy text of the printing and

                    </p> --}}
                </div>
            </div>

        </div>


    </section>
    <section id="featured_events" class="pt-5 pb-5 bg-grey">
            @include('frontend.includes.featured') 
       
    </section>
@endsection


@push('after-scripts')
        {!! Captcha::script() !!}
@endpush


