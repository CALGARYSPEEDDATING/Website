@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))
<style>

</style>
@section('content')

<section id="registration" class="main_padding">
    <div class="container">
        <div class="row">

            <div class="col-sm-12">
                <div class="signup_container">
                    <h2>SIGN UP NOW</h2>
                <form method="POST" action="{{route('frontend.auth.register.post')}}" id="signup-form" class="signup-form">
                        @csrf
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
                                <select  id="gender" name="gender" required>
                                    <option value="">-- Choose one ---</option>
                                    <option value="1">Female</option>
                                    <option value="0">Male</option>
                                    

                                </select>

                            </div>

                            {{-- <div class="form-group">
                                <label for="screenname" class="form-label required">Screenname</label>
                                <input type="text" name="screenname" id="screenname" />
                            </div> --}}
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
                                <label for="email" class="form-label required" >Email</label>
                                <input type="email" name="email" id="email" required>
                            </div>
                            <div class="form-group">
                                <label for="phone" class="form-label required">Primary Phone <i data-toggle="tooltip" data-placement="top" 
                                    title="we ask for cell phone numbers so we can text important event detail changes as some attendees 
                                    may not get emails quickly enough. We do not share your phone number with anybody and only use it for event purposes" 
                                    class="fa fa-question-circle tool-p-phone" aria-hidden="true"></i></label>
                                <input type="text" name="phone" id="phone" maxlength="12" placeholder="xxx-xxx-xxxx">
                            </div>

                            <div class="form-group">
                                <label for="a_phone" class="form-label">Alternate Phone <i data-toggle="tooltip" data-placement="top" title="we ask for cell phone numbers so we can text important event detail changes as some attendees may not get emails quickly enough. We do not share your phone number with anybody and only use it for event purposes" class="fa fa-question-circle tool-alt-phone" aria-hidden="true"></i></label>
                                <input type="text" name="a_phone" id="a_phone" maxlength="12" placeholder="xxx-xxx-xxxx">
                            </div>

                            <div class="form-group">
                                <label for="matches_contact" class="form-label required">Contact information for matches</label>
                                <select  id="matches_contact" name="matches_contact" required>
                                    <option value="">-- Choose one ---</option>
                                    <option value="Primary Email">Primary Email</option>
                                    <option value="Primary Phone">Primary Phone</option>
                                    <option value="Both">Both</option>
    
                                </select>
                                {{-- <input placeholder="Email or Phone Number" type="text" name="matches_contact" id="matches_contact"> --}}
                            </div>

                            <div class="form-group">
                                <label for="heard_about_us" class="form-label required">Where did you hear about Calgary Speed Dating?</label>
                                <input type="text" name="heard_about_us" id="heard_about_us" >
                            </div>

                            <div class="form-check">
                                 
                            <input style="width: 10%;" type="checkbox" class="form-check-input" id="agree" name="agree" value="1">

                            <label style="margin-left: 30px;" class="form-check-label" for="agree" class="form-label required"><a href="{{route('frontend.policies')}}"> I have read and agree to the all policies on the Policies & FAQ page.</a></label>
                            </div>

                            {{-- <div class="form-group">
                                <label for="city" class="form-label">City / Postcode</label>
                                <input type="text" name="city" id="city" required>
                            </div> --}}


                        </fieldset>


                    </form>
                    <div class="text-center pb-5">
                        <h6>Already a Member? <a href="{{route('frontend.auth.login')}}" class="font-weight-bold">Login</a></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- Featured --}}
<section id="featured_events" class="pt-5 pb-5 bg-grey">
        @include('frontend.includes.featured')

</section>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirm Registration</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div>
            <strong>First name:</strong> <span class="first_name"></span>                
        </div>
        <div>
           <strong> Last Name: </strong><span class="last_name"></span>                
        </div>
        <div>
           <strong> Date of Birth:</strong> <span class="birth_date"></span>                
        </div>
        <div>
           <strong> Birth Month:</strong> <span class="birth_month"></span>                
        </div>
        <div>
            <strong>Birth year:</strong> <span class="birth_year"></span>                
        </div>
        <div>
            <strong>Gender:</strong> <span class="gender"></span>                
        </div>
        <div>
           <strong> Email:</strong> <span class="email"></span>                
        </div>
        <div>
            <strong>Phone:</strong> <span class="phone"></span>                
        </div>
        <div>
            <strong>Alternative Phone:</strong> <span class="a_phone"></span>                
        </div>
        <div>
            <strong>matches_contact:</strong> <span class="matches_contact"></span>                
        </div>
        <div>
            <strong>Heared about us:</strong> <span class="heard_about_us"></span>                
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" style="background: #FF0000 !important" class="btn btn-secondary" data-dismiss="modal">Back</button>
        <button type="button" id="confirm" style="background: #FF0000 !important" class="btn btn-primary">Confirm & Submit</button>
      </div>
    </div>
  </div>
</div>


@push('after-scripts')
<script>
    function toTitleCase(str) {
        return str.split(/\s+/).map(s => s.charAt(0).toUpperCase() + s.substring(1).toLowerCase()).join(" ");
    }
    $('#first_name').on('keyup', function(event) {
    var $t = $(this);
    $t.val(toTitleCase($t.val()));
    });
    $('#last_name').on('keyup', function(event) {
    var $t = $(this);
    $t.val(toTitleCase($t.val()));
    });


    // test
    $("#phone").focusout(function() {
        $('.tool-p-phone').tooltip({trigger:'manual'}).tooltip('hide');
    })
    .focusin(function () {
        $('.tool-p-phone').tooltip({trigger:'manual'}).tooltip('show');
    });

    $("#a_phone").focusout(function() {
        $('.tool-alt-phone').tooltip({trigger:'manual'}).tooltip('hide');
    })
    .focusin(function () {
        $('.tool-alt-phone').tooltip({trigger:'manual'}).tooltip('show');
    });

    $('#phone, #a_phone').keyup(function(){
        $(this).val($(this).val().replace(/(\d{3})\-?(\d{3})\-?(\d{4})/,'$1-$2-$3'))
    });
</script>
@endpush
@endsection
