@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.frontend.contact.box_title'))

@section('content')
<div id="banner" class="detail_page">
        <section class=" pt-5 pb-5">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="breadcrumb-text text-center">
                            <h1 class="text-white title-main"> Testimonials </h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <section id="faq" class="pt-5">
            <div class="container">
                {{-- <div class="row ">
                    <div class="col-sm-12">
                        
                    </div>
                </div> --}}
               
                <div class="row">
                    <div class="col-12">
                            <h4 class="p-0 mb-4"> All of the testimonials below are from real Calgarians. They have all been to a Calgary Speed Dating event.</h4>
                        <div class="question_answer mb-5">
                            
                    
                        </div>
                        <blockquote class="blockquote text-left">
                                <p class="mb-0">We met through Calgary Speed Dating and immediately hit it off! In less than two years we were married and are living a very joyful life together! 

                                        Thank you Cathy for hosting such a fun and respectful event - we are so grateful.</p>
                                <footer class="blockquote-footer"> Erin & Alex - <cite title="Source Title">February, 2018</cite></footer>
                              </blockquote>
                        <blockquote class="blockquote text-right">
                                <p class="mb-0">I have attended three Calgary Speed Dating matching events and although a 'connection' was not made, the evening and process is offered in the utmost professional, discrete and comfortable manner. Cathy coordinates these events to provide the opportunity to safely meet a 'match' while its completely up to the participants to form the 'connection' with who we have been matched with.

                                        This service is top notch and the overall experience is very enjoyable. 7 minutes of talking passes very quick but its long enough to get a sense of whether a connection might happen or not. I definitely recommend this to singles looking to meet another single!
                                        
                                        Thank you for offering this service as a way to help people find their connections! Male, 49 years.</p>
                                <footer class="blockquote-footer"><cite title="Source Title">February, 2018 </cite></footer>
                              </blockquote>
        
        
        
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





@endsection