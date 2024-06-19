@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.frontend.contact.box_title'))

@section('content')

<section id="faq" class="pt-5">
        <div class="container">
            <div class="row ">
                <div class="col-sm-12">
                    <h2 class="p-0 mb-4 section-title">Waiver:</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="question_answer mb-5">
                        <h3> Express Consent</h3>


                        <p>     I, <span style="text-decoration: underline; font-weight:bold;">{{$logged_in_user->full_name}}</span>, being over 18 years of age, understand
                    and accept that Calgary Speed Dating Inc. does not conduct background checks or
                    otherwise screen participants registering to this service in any way. I understand that I must
                    take all necessary precautions when meeting another participant of this service to ensure
                    that I do so in a safe environment during any planned or impromptu meetings.</p>


                    <p>  For myself, my heirs, successors and executors, I hereby knowingly and
                    intentionally waive and release, indemnify and hold harmless Calgary Speed Dating Inc.,
                    its directors, officers, agents and employees, from and against any and all claims, actions,
                    causes of action, liabilities, suits, expenses (including reasonable attorney’s fees) and
                    negligence of any kind and nature, whether foreseen or unforeseen, arising directly or
                    indirectly out of any damage, loss, injury, paralysis, or death to me or my property as a
                    result of my participation in the activities of Calgary Speed Dating Inc.</p>


                    <p>  Notwithstanding anything to the contrary contained herein, our liability to you for
                    any cause whatsoever, and regardless of the form of the action, will at all times be limited
                    to the amount paid, if any, by you to us for the use of service of Calgary Speed Dating Inc.
                    for this event.</p>


                    <p> We will not be liable for any damages, direct, indirect, incidental and/or
                    consequential, including, but not limited to, physical damages, bodily injury or emotional
                    distress, arising out of the use of this service, including, without limitation, damages arising
                    out of the use of this service, including, without limitation, damages arising out of your
                    communications with and/or interactions with any other participants of this service, or any
                    individual you meet via this service.</p>


                    <p> I understand and accept that Calgary Speed Dating Inc. keeps a record of my birth
                    date solely for verifying ages to keep the integrity of the events. Calgary Speed Dating Inc.
                    respects your privacy; we will not share, sell, trade, rent or release your private information
                    to anyone outside our company, affiliates, individuals and business partners. </p>


                    {{-- style="font-weight:bold" --}}


                    
                    </div>
                    
            </div>
            
         
            {{-- <form action="">
                    <input type="checkbox" class="form-checkbox" name="agree" id="user_agreed">
            
            
                </form> --}}
        </div>
        <form action="{{route('frontend.events.waiver.post', request()->route('id'))}}" method="post">
            @csrf
        <div class="row">
                <div class="col-lg-3 col-6">
                        <input type="checkbox" class="form-check-checkbox" value="1" name="agree" id="agree" required>
                        I agree 
                </div>
                {{-- <div class="col-12 mt-3">
                        
                    </div> --}}
                <div class="col-12 mt-3">
                <a href="{{ url()->previous() }}" class="float-left btn btn-warning btn-lg">Back</a>
                    <button type="submit" class="float-right btn btn-theme btn-lg">Continue</button>
                </div>
            </div>
        </form>
        <hr>
        {{-- {{request()->route('id')}} --}}
    </section>

    
@endsection