@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.frontend.contact.box_title'))

@section('content')
<div id="banner" class="detail_page">
    <section class=" pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="breadcrumb-text text-center">
                        <h1 class="text-white title-main"> How It Works</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


{{-- How --}}

<section id="faq" class="pt-5">
        <div class="container">
            <div class="row ">
                <div class="col-sm-12">
                    <h2 class="p-0 mb-4 section-title">What to Expect:</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="question_answer mb-5">
                        
                        <p>Upon arriving, you'll register - be sure you bring id with your birth date on it - pick up your dating card and the profiles of the singles you'll be meeting. Beverages are available for purchase. You can either mingle or read the profiles to familiarize yourself with the other participants before you meet them.</p>
    
                        <p> After a short welcome and explanation of how the dating cards work, the 7-minute dates commence. Choose to converse rather than interrogate. Conversation will put the other person at ease and those 7 minutes will fly by. </p>

                        <p>Each person is assigned a table number. At the end of each 7 minutes, a bell rings and the men will move to the next highest table number. This is the time to secretly indicate on your dating card whether you'd like to see that person again. 
                            </p>

                        <p>The break occurs around 8:30 and it will last 15-20 minutes. We supply the snacks! Then we resume until the end of the rounds. Events can end anywhere between 9:45 and 10:15, depending upon the size of the group.</p>


                        <p>Just before you go home, you'll hand in your dating card, but take the profile sheet to help remind you who everyone is the next day. </p>

                        <p>Expect an email with your matches usually the same night but before 1 p.m. the next day for sure. Once you have your matches the rest is up to you!</p>

                        <p>Be aware that email servers can be sensitive and may consider "dating" a spam word. If you do not receive an email in your Inbox then check your Spam/junk mail folder. If you still do not have an email then text/call us at 403-219-3283 or email us <span><a href="mailto:info@calgaryspeeddating.com?Subject=Hello%20">Here</a></span>. Best to put our email on your safe list.</p>
                    </div>
    
    
    
    
                    {{-- <div class="question_answer">
                        <h3>Policy on Privacy</h3>
                        <p>We offer our clients anonymity by dealing only on a first names basis (and occasionally the
                            first initial of your last name) at any event. You will either have specified how you would
                            like your matches to contact you during the registration process or on the dating card you're
                            given at the event. That is the only information given out the next day.</p>
    
                        <p>Upon arrival at an event, you will be asked to provide your driver's licence to confirm birth
                            dates. We will record your birth date only for the purpose of confirming ages to keep the
                            integrity of the events. All information is kept strictly for our records and will NOT be
                            shared with any other individual or company.</p>
    
                        <p>We don't keep any credit card information you provide for payment.</p>
    
                        <p>Pre-payment is the only way to secure a seat at any event. If you have paid for an event and are
                            unable to attend, notify us ASAP.</p>
    
                        <p>The only circumstance under which a refund will be issued, is if we cancel an event. We don't
                            cancel events on a whim. We cancel events because we don't want you to have a mediocre time. If
                            we can't fill an event, we cancel it. At that point, you're notified and a refund is issued.</p>
    
                        <p> Please understand that we have been driven to this by groups of people who register for an
                            event together as friends and then cancel as a group leaving us scrambling to fill their seats
                            or cancel the entire event. There will be no refunds from this point on.</p>
    
                        <p>If you cancel 48 hours or more from the event date, you will be issued a credit for a future
                            event. Less than 48 hours notice from the event date, you forfeit your payment.</p>
    
                        <p> If you have any questions about this, please don't hesitate to give us a call at 403-219-3283.
                            We will be happy to discuss this with you.</p>
                    </div>
     --}}
              
            </div>
        </div>
        <hr>
        </div>
    </section>

{{-- Upcoming --}}
<section id="upcomming_event" class="pb-5">
    @include('frontend.includes.upcoming')

    </section>

@endsection