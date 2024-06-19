@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))

@section('content')
<section id="registration" class="main_padding">
        <div class="container">
            <div class="row">

                <div class="col-sm-12">
                    <div class="signup_container">
                        <h2>SIGN UP NOW</h2>
                        <form method="POST" id="signup-form" class="signup-form">
                            <h3>
                                <span class="icon"><i class="ti-user"></i></span>
                                <span class="title_text">Personal</span>
                            </h3>
                            <fieldset>
                                <legend>
                                    <span class="step-heading">Personal Informaltion: </span>
                                    <span class="step-number">Step 1 / 2</span>
                                </legend>
                               
                                <div class="form-group">
                                        <label for="first_name" class="form-label required">First name</label>
                                        <input type="text" name="first_name" id="first_name" />
                                    </div>
                                    <div class="form-group">
                                        <label for="last_name" class="form-label required">Last name</label>
                                        <input type="text" name="last_name" id="last_name" />
                                    </div>
                                <div class="form-group">
                                    <label for="email" class="form-label required">Email</label>
                                    <input type="email" name="email" id="email" />
                                </div>
                                <div class="form-date">
                                        <label for="birth_date" class="form-label required">Date of birth</label>
                                        <div class="form-date-group">
                                            <div class="form-date-item">
                                                <select id="birth_date" name="birth_date"></select>
                                                <span class="select-icon"><i class="ti-angle-down"></i></span>
                                            </div>
                                            <div class="form-date-item">
                                                <select id="birth_month" name="birth_month"></select>
                                                <span class="select-icon"><i class="ti-angle-down"></i></span>
                                            </div>
                                            <div class="form-date-item">
                                                <select id="birth_year" name="birth_year"></select>
                                                <span class="select-icon"><i class="ti-angle-down"></i></span>
                                            </div>
                                        </div>
                                    </div>

                                
                                <div class="form-group">
                                        <label for="gender" class="form-label required">Gender</label>
                                        <select id="gender" name="gender" >
                                            <option value="">-- Choose one ---</option>
                                            <option value="1">Male</option>
                                            <option value="2">Female</option>
                                        </select>
    
                                    </div>

                                    <div class="form-group">
                                            <label for="password" class="form-label required">Password</label>
                                            <input type="password" name="password" id="password" />
                                        </div>

                                        <div class="form-group">
                                                <label for="password_confirmation" class="form-label required">Confirm Password</label>
                                                <input type="password" name="password_confirmation" id="password_confirmation" />
                                            </div>
                                            

                            </fieldset>

                            <h3>
                                <span class="icon"><i class="ti-email"></i></span>
                                <span class="title_text">Contact</span>
                            </h3>
                            <fieldset>
                                <legend>
                                    <span class="step-heading">Contact Informaltion: </span>
                                    <span class="step-number">Step 2 / 2</span>
                                </legend>
                                
                                <div class="form-group">
                                    <label for="phone" class="form-label ">Primary Phone</label>
                                    <input type="number" name="phone" id="phone">
                                </div>
                                <div class="form-group">
                                        <label for="a_phone" class="form-label ">Alternate Phone</label>
                                        <input type="number" name="a_phone" id="a_phone">
                                    </div>

                                <div class="form-group">
                                        <label for="matches_contact" class="form-label ">Contact information for matches</label>
                                        <input type="number" name="matches_contact" id="matches_contact">
                                    </div>

                                <div class="form-group">
                                    <label for="where" class="form-label">Where did you hear about Calgary Speed Dating?</label>
                                    <input type="text" name="where" id="where" required>
                                </div>
                                <div class="form-check">
                                        <label class="form-check-label" for="agree">Check me out</label>
                                        <input type="checkbox" class="form-check-input" id="agree" required>
                                        <a> I have read and agree to the all policies on the Policies & FAQ page.</a>
                                </div>

                            </fieldset>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="featured_events" class="pt-5 pb-5 bg-grey">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <h2 class="p-0 m-0 section-title mb-5">Featured Events</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card featured_events_card shadow pb-4 mb-5 border-0">
                            <div class="feautured_events_image positive-relative">
                                <img src="images/feature_event.png" alt="logo">
                                <div class="feature_event_pub_date">
                                    <h2 class="event_date mb-1 font-weight-bold">5</h2>
                                    <h6 class="event_month mb-1">Feb</h6>
                                    <h6 class="event_day">Tue</h6>
                                </div>
                            </div>
                            <div class="feature_events_description">
                             
                                    <a href="#">
                                        <h4 class="p-4 text-dark">Giant Valentine's Speed Dating - tickets on
                                            sale now!</h4>
                                    </a>
                                    <div class="row">
                                        <div class="col-7 ">
                                            <p class="pl-4 d-flex"><i class="fal fa-map-marker-alt text_primary mr-2 mt-1"></i>
                                                Lorem Ipsum is simply dummy text of the printing and</p>
                                        </div>
                                        <div class="col-5 ">
                                            <p class="pr-4"><strong class="text_primary">Age group:</strong>
                                                24-40</p>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="row">
                                        <div class="col-7">
                                            <p class="pl-4"><strong class="text_primary">Women:</strong> Places
                                                Available</p>
                                        </div>
                                        <div class="col-5">
                                            <p class="pr-4"><strong class="text_primary">Men:</strong>
                                                Places
                                                Available</p>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card featured_events_card shadow pb-4 border-0">
                            <div class="feautured_events_image positive-relative">
                                <img src="images/feature_event.png" alt="logo">
                                <div class="feature_event_pub_date">
                                    <h2 class="event_date mb-1 font-weight-bold">5</h2>
                                    <h6 class="event_month mb-1">Feb</h6>
                                    <h6 class="event_day">Tue</h6>
                                </div>
                            </div>
                            <div class="feature_events_description">
                                <a href="#">
                                    <h4 class="p-4 text-dark">Giant Valentine's Speed Dating - tickets on sale
                                        now!</h4>
                                </a>
                                <div class="row">
                                    <div class="col-7">
                                        <p class="pl-4 d-flex"><i class="fal fa-map-marker-alt text_primary mr-2 mt-1"></i>
                                            Lorem Ipsum is simply dummy text of the printing and</p>
                                    </div>
                                    <div class="col-5">
                                        <p class="pr-4"><strong class="text_primary">Age group:</strong>
                                            24-40</p>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="row">
                                    <div class="col-7">
                                        <p class="pl-4"><strong class="text_primary">Women:</strong> Places
                                            Available</p>
                                    </div>
                                    <div class="col-5">
                                        <p class="pr-4"><strong class="text_primary">Men:</strong>
                                            Places
                                            Available</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          
        </section>


@endsection