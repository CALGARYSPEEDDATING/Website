@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.frontend.contact.box_title'))

@section('content')
<section class="payment-form dark main_padding">
        <div class="container">
            <div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-labelledby="newModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="newModalLabel">Policies</h5>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="question_answer">
                                        <h4>Please note: If you cancel 48 hours or more from the event date, you will be issued a credit for a future event. Less than 48 hours notice from the event date, you forfeit your payment. The only circumstance under which a refund will be issued, is if we cancel an event. A lot goes into organizing these events hence sudden withdrawals from the event negatively impact it.</h4>
                                    </div>
                                </div>
                                    <button class="btn btn-theme btn-lg ml-2" onclick="acceptCookieConsent();">Agree</button>   
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div class="credit-hide">
            <form method="Post" name="checkout_form" onsubmit="validateForm(this);">
                @csrf
                    <div class="products">
                        {{-- <h3 class="title">F: {{$event->details->female_age_from}}-{{$event->details->male_age_to}}  , M: {{$event->details->male_age_to}}-{{$event->details->male_age_to}}, #724 
                                                        (We have a 2yr leeway on the low and high end of the ages)</h3> --}}
                    <h3 class="title">{{$event->title}} #{{$event->id}}</h3>  
                                                        
                                                        
                        <div class="item">
                            <span class="price">
                                    
                                @if(session()->get('gender') == 0)
                                $ {{$event->price_male}}
                                @else
                                $ {{$event->price_female}}
                                @endif
                                
                            </span>
                        <p class="item-name">{{$event->title}} #{{$event->id}}</p>
                            <div class="row mt-3 product_item-description">
                                <div class="col-8">
                                    <p class="mb-2 d-flex"><span class="text_primary mr-3"><strong>Where:</strong></span>
                                        <a target="_blank" href="http://maps.google.com/?q={{ $event->address }}">{{$event->address}}</a></p>
                                </div>
                                <div class="col-4">
                                    <p class="mb-2"><span class="text_primary"><strong>Time:
                                            </strong></span>{{ date("F j, Y", strtotime($event->start_datetime)) }} at
                                            {{date("g:i a",
                                            strtotime($event->start_datetime))}}</p>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="row product_item-description">
                                    @if ($event->type != 2)
                                <div class="col-8">
                                    <p><span class="text_primary mr-1"><strong>Women: </strong></span>
                                        Available</p>
                                </div>
                                @endif
                                @if ($event->type != 1)
                                <div class="col-4">
                                    <p><span class="text_primary"><strong>Men: </strong></span>
                                        Available</p>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="total">Taxes<span class="price">
                            @if(session()->get('gender') == 0)
                                $ {{((float)$event->price_male * 0.05)}}
                                @else
                                $ {{((float)$event->price_female * 0.05)}}
                                @endif
                        </span></div>
                        <div class="total">Total<span class="price">
                                @if(session()->get('gender') == 0)
                                $ {{ (float)$event->price_male + ((float)$event->price_male * 0.05) }}
                                @else
                                $ {{ (float)$event->price_female + ((float)$event->price_female * 0.05) }}
                                @endif
                    
                        
                        </span></div>
                    </div>
                    <div class="card-details">
                            <div class="row float-right">
                                <div class="col-12 ">
                                <i class="fa-2x fab fa-cc-visa"></i>
                                <i class="fa-2x fab fa-cc-discover"></i>
                                <i class="fa-2x fab fa-cc-mastercard"></i>
                                <i class="fa-2x fab fa-cc-amex"></i>
                                </div>
                                </div>
                        <h3 class="title">Credit Card Details</h3>

                        
                        <div class="row">
                            <div class="form-group col-sm-7">
                                <label for="card-holder">Card Holder</label>
                            <input name="card_holder" value="{{$logged_in_user->full_name}}" id="card-holder" type="text" class="form-control input-lg" placeholder="Card Holder"
                                    >
                            </div>

                            @if(session()->get('gender') == 0)
                            <input type="hidden" name="amount" value="{{ (float)$event->price_male + ((float)$event->price_male * 0.05) }}">
                            @else
                            <input type="hidden" name="amount" value="{{ (float)$event->price_female + ((float)$event->price_female * 0.05) }}">
                            @endif
                        
                            <div class="form-group col-sm-5">
                                <label for="experiration_date">Expiration Date</label>
                                <div class="input-group expiration-date">
                                    {{-- <input type="text" class="form-control input-lg" id="experiration_date" placeholder="MM" > --}}
                                    <select name="card_expiry_date" class="form-control input-lg" name="cardExpiryMonth">
                                            <option value="" selected>EXPIRY Month *</option>
                                            @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{date( 'm', mktime( 0, 0, 0, $i + 1, 0, 0 ) )}}">{{date( 'F', mktime( 0, 0, 0, $i + 1, 0, 0 ) )}}</option>
                                            @endfor
                                            </select>


                                    <span class="date-separator">/</span>
                                    <select name="card_expiry_year"  id="expiry" class="form-control input-lg"  >
                                            <option value="" selected disabled>EXPIRY Year*</option>
                                            @for($i = 2019; $i <= 2035; $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                            </select>
                                    {{-- <input type="text" class="form-control input-lg" placeholder="YY" > --}}
                                </div>
                            </div>
                            <div class="form-group col-sm-8">
                                <label for="card-number">Card Number</label>
                                <input name="card_number" id="card-number" type="text" class="form-control input-lg" placeholder="Card Number">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="cvc">CVC</label>
                                <input id="cvc" name="card_cvc" type="text" class="form-control input-lg" placeholder="CVC">
                            </div>
                            <div class="wrap-input100 validate-input" data-validate="Message is required">
                                    {!! Captcha::display() !!}
                                    {{ html()->hidden('captcha_status', 'true') }}
                                    @if ($errors->has('g-recaptcha-response'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                        </span>
                                    @endif
                            </div>
                            <label for="honeypot">Honeypot </label>
                            <input id="honeypot" name="honeypot" size="40" type="text" />
                            <div class="form-group col-sm-12">
                                <button type="submit" class="btn btn-theme btn-block">Proceed</button>
                            </div>


                            {{-- <div class="form-group col-sm-12">
                                    <button type="button" class="btn btn-warning btn-block">Pay Later</button>
                                </div> --}}
                        </div>
                    </div>
            </form>
        </div>
        <div class="credit-form">
            <form method="Post" action="{{route('frontend.events.checkout.creditpost', request()->route('id'))}}">
                @csrf
                    <div class="products">
                        {{-- <h3 class="title">F: {{$event->details->female_age_from}}-{{$event->details->male_age_to}}  , M: {{$event->details->male_age_to}}-{{$event->details->male_age_to}}, #724
                                                        (We have a 2yr leeway on the low and high end of the ages)</h3> --}}
                    <h3 class="title">{{$event->title}} #{{$event->id}}</h3>


                        <div class="item">
                            <span class="price credit-show">

                                @if(session()->get('gender') == 0)
                                $ {{$event->price_male}}
                                @else
                                $ {{$event->price_female}}
                                @endif

                            </span>
                        <p class="item-name">{{$event->title}} #{{$event->id}}</p>
                            <div class="row mt-3 product_item-description">
                                <div class="col-8">
                                    <p class="mb-2 d-flex"><span class="text_primary mr-3"><strong>Where:</strong></span>
                                        <a target="_blank" href="http://maps.google.com/?q={{ $event->address }}">{{$event->address}}</a></p>
                                </div>
                                <div class="col-4">
                                    <p class="mb-2"><span class="text_primary"><strong>Time:
                                            </strong></span>{{ date("F j, Y", strtotime($event->start_datetime)) }} at
                                            {{date("g:i a",
                                            strtotime($event->start_datetime))}}</p>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="row product_item-description">
                                    @if ($event->type != 2)
                                <div class="col-8">
                                    <p><span class="text_primary mr-1"><strong>Women: </strong></span>
                                        Available</p>
                                </div>
                                @endif
                                @if ($event->type != 1)
                                <div class="col-4">
                                    <p><span class="text_primary"><strong>Men: </strong></span>
                                        Available</p>
                                </div>
                                @endif
                            </div>
                        </div>
                        <input type="hidden" name="use_credit" value=""/>
                        <div class="form-group col-sm-12">
                            <button type="submit" class="btn btn-theme btn-block">Proceed</button>
                        </div>
                    </div>
                </form>
        </div>
            <div class="row">
				
			</div>
        </div>
    </section> 
    <section id="featured_events" class="pt-5 pb-5">
            @include('frontend.includes.featured')     
    </section>
    @push('after-scripts')
    <script>
        $("#newModal").modal({
            backdrop: 'static',
            keyboard: false
        });
        $('#newModal').modal('show');
        function acceptCookieConsent(){
            $("#newModal").modal("hide");
        }
		function validateForm(form) {
			debugger;
			var x = document.forms["checkout_form"]["honeypot"].value;
			if ( x == "" || x == null ){ // if the honeypot was ignored, it's a hu-mon
				form.action="{{route('frontend.events.checkout.post', request()->route('id'))}}"; // link to process form and redirect to thank you
			}
			else{ // the honeypot was filled in, it's a robot
				form.action="http://..." // link directly to thank you without actually processing form    
				return false;
				}
		}
		$('.credit-form').hide();
        var creditCheck=localStorage.getItem('credit');
        if(creditCheck){
            $('.credit-show').html('(Credit: 1)');
            $('.use_credit').val(creditCheck);
            $('.credit-hide').hide();
            $('.credit-form').show();
        }
    </script>
    @endpush
    
    @push('after-scripts')
            {!! Captcha::script() !!}
    @endpush
@endsection