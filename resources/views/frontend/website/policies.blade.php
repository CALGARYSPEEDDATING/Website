@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.frontend.contact.box_title'))

@section('content')
<div id="banner" class="detail_page">
    <section class=" pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="breadcrumb-text text-center">
                        <h1 class="text-white title-main"> Policies</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

{{-- Polices--}}
<section id="faq" class="pt-5">
    <div class="container">
        <div class="row ">
            <div class="col-sm-12">
                <h2 class="p-0 mb-4 section-title">Policies:</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="question_answer mb-5">
                    <h3> Express Consent</h3>
                    <p class="font-weight-bold">By registering for an event, you are giving your EXPRESS CONSENT to
                        receive emails and/or texts from Calgary Speed Dating. We will not sell or otherwise share your
                        email address with any other company. We will not share your email address with any other
                        participant, unless you specify that email address as your match contact information.
                        We send the occasional email update of future events, depending upon your age and gender.</p>

                    <p> We will occasionally text or phone you if we have been unable to reach you by any other means.
                        You will not be inundated with junk mail from us. You can stop receiving any communication from
                        us by unsubscribing.</p>
                </div>




                <div class="question_answer">
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

                {{-- <div class="question_answer mb-5">
                    <h3> Policy on Staff and Participant Treatment</h3>
                    <p>Calgary Speed Dating will not tolerate any mistreatment to staff or other participants. Anyone
                        acting with disrespect will be asked to leave and will forfeit any payment made. </p>
                </div>

            </div>
            --}}
        </div>
    </div>
    <hr>
  
</section>



<section class="pb-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="question_answer">
                    <h3> Policy on Staff and Participant Treatment</h3>
                    <p>Calgary Speed Dating will not tolerate any mistreatment to staff or other participants. Anyone
                        acting with disrespect will be asked to leave and will forfeit any payment made. </p>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
{{-- End Policies--}}

{{-- Upcoming --}}
<section id="upcomming_event" class="pb-5">
    @include('frontend.includes.upcoming') 
</section>

@endsection
