@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.frontend.contact.box_title'))

@section('content')
<div id="banner" class="detail_page">
    <section class=" pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="breadcrumb-text text-center">
                        <h1 class="text-white title-main"> FAQ </h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<section class="pt-5">
    <div class="container">
        <div class="row mb-4">
            <div class="col-sm-12">
                <h2 class="p-0 m-0 section-title">Frequently Asked Questions</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div id="accordion">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"
                                    aria-expanded="true" aria-controls="collapseOne">
                                    Why use Calgary Speed Dating?
                                </button>
                            </h5>
                        </div>

                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                We have been doing this for more than 17 years. We were the first speed dating company
                                in Calgary and are the longest running in Canada. We know what we are doing and provide
                                the best experience. We hold events in a cozy venue that is quite private during the
                                events. We value your privacy. We won't give anyone your last name and other than
                                pictures from our Guinness World Record event, you will never find your picture on our
                                website. We strive to make everyone's experience enjoyable. We want to deliver what we
                                promise. So, we require everyone to bring id to the events and we check everyone's
                                birth date. We don't put up with any bad behavior. (Luckily, we don't have to deal with
                                that often. It's rare that there is any bad behavior at the events.) We keep track of
                                events you've attended and strive to make sure you don't speed date with the same
                                people you've already met, though once in awhile there will be someone you've met but
                                not matched with from a precious event. We ask every participant to fill out a short
                                profile. Nothing too personal - just general things like interests, where they've
                                traveled, that sort of thing. It's just a good jumping off point for great
                                conversations. We serve food at a break we take in the middle of the evening. It's a
                                yummy snack!
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingTWO">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseTWO"
                                    aria-expanded="true" aria-controls="collapseTWO">
                                    Why do I have to pay in advance?
                                </button>
                            </h5>
                        </div>

                        <div id="collapseTWO" class="collapse" aria-labelledby="headingTWO" data-parent="#accordion">
                            <div class="card-body">
                                Everyone is required to pay for their event ahead of time. Otherwise, there is no
                                commitment to attend. As the male/female ratio must be even (or very close), a no-show
                                can harm speed dating events.
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingthree">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapsethree"
                                    aria-expanded="true" aria-controls="collapsethree">
                                    Why do I have to bring id?
                                </button>
                            </h5>
                        </div>

                        <div id="collapsethree" class="collapse" aria-labelledby="headingthree" data-parent="#accordion">
                            <div class="card-body">
                                To protect the integrity of the events, participants are required to bring a driver's
                                license or other form of picture id to the events.
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingfour">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapsefour"
                                    aria-expanded="true" aria-controls="collapsefour">
                                    How many people match?
                                </button>
                            </h5>
                        </div>

                        <div id="collapsefour" class="collapse" aria-labelledby="headingfour" data-parent="#accordion">
                            <div class="card-body">
                                While the number fluctuates from event to event, and age group, participants match an
                                average 76% of the time.
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingfive">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapsefive"
                                    aria-expanded="true" aria-controls="collapsefive">
                                    Why should I try Calgary Speed Dating?
                                </button>
                            </h5>
                        </div>

                        <div id="collapsefive" class="collapse" aria-labelledby="headingfive" data-parent="#accordion">
                            <div class="card-body">
                                The beauty of Calgary Speed Dating is that you get the opportunity to Calgary singles
                                in person. We call it offline dating. At our events, you get to meet an average of 12
                                singles in one evening and see immediately if any sparks fly. Different people attend
                                every event. It's fun, exciting the best way to have that human connection. Most people
                                that visit us are tired of online dating and have a blast when they attend.
                            </div>
                        </div>
                    </div>

                    {{-- <div class="card">
                        <div class="card-header" id="headingfive">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapsefive"
                                    aria-expanded="true" aria-controls="collapsefive">
                                    Why should I try Calgary Speed Dating?
                                </button>
                            </h5>
                        </div>

                        <div id="collapsefive" class="collapse" aria-labelledby="headingfive" data-parent="#accordion">
                            <div class="card-body">
                                The beauty of Calgary Speed Dating is that you get the opportunity to Calgary singles
                                in person. We call it offline dating. At our events, you get to meet an average of 12
                                singles in one evening and see immediately if any sparks fly. Different people attend
                                every event. It's fun, exciting the best way to have that human connection. Most people
                                that visit us are tired of online dating and have a blast when they attend.
                            </div>
                        </div>
                    </div> --}}

                    {{-- <div class="card">
                        <div class="card-header" id="headingsix">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapsesix"
                                    aria-expanded="true" aria-controls="collapsesix">
                                    Who attends Calgary Speed Dating?
                                </button>
                            </h5>
                        </div>

                        <div id="collapsesix" class="collapse" aria-labelledby="headingsix" data-parent="#accordion">
                            <div class="card-body">
                                Calgary Speed Dating is for single people over 18 looking to find that 'someone
                                special'. There are no ethnic or religious barriers.
                            </div>
                        </div>
                    </div> --}}


                    <div class="card">
                        <div class="card-header" id="headingseven">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseseven"
                                    aria-expanded="true" aria-controls="collapseseven">
                                    What if there aren't enough participants?
                                </button>
                            </h5>
                        </div>

                        <div id="collapseseven" class="collapse" aria-labelledby="headingseven" data-parent="#accordion">
                            <div class="card-body">
                                In the unlikely event that there aren't enough of one gender, we will cancel the event
                                and either refund or credit your money - your choice. Our events average 12 of each
                                gender but if we were to have at least 8 of each, we would still go ahead. We consider
                                that meeting 8 of the opposite sex in one evening is still a good number of people to
                                meet. (Note that though we do our best to make sure it doesn't happen, same day
                                drop-outs and event no-shows can occur. We can only do so much!)
                            </div>
                        </div>
                    </div>

                    {{-- Added --}}
                    <div class="card">
                        <div class="card-header" id="headingeight">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseeight"
                                    aria-expanded="true" aria-controls="collapseeight">
                                    Does it cost anything to register?
                                </button>
                            </h5>
                        </div>

                        <div id="collapseeight" class="collapse" aria-labelledby="headingeight" data-parent="#accordion">
                            <div class="card-body">
                                The total cost per event is $55.00 plus GST, which includes matches the next day. There
                                will also be complimentary snacks served at the break. There are no hidden charges. You
                                do not pay extra to receive your match or matches.
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" id="headingnine">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapsenine"
                                    aria-expanded="true" aria-controls="collapsenine">
                                    Do you do any screening?
                                </button>
                            </h5>
                        </div>

                        <div id="collapsenine" class="collapse" aria-labelledby="headingnine" data-parent="#accordion">
                            <div class="card-body">
                                Unfortunately, people ask us to screen for almost everything from profession, body
                                type, race, religion to parenthood, etc. If we were to screen for everyone's
                                likes/dislikes, we would never be able to put on an event! Consequently, we let you do
                                your own screening. After all, ultimately, it is you who has decide who is right for
                                you. No one else can do it for you.
                            </div>
                        </div>
                    </div>



                    <div class="card">
                        <div class="card-header" id="headingten">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseten"
                                    aria-expanded="true" aria-controls="collapseten">
                                    How many times can I attend Calgary Speed Dating events?
                                </button>
                            </h5>
                        </div>

                        <div id="collapseten" class="collapse" aria-labelledby="headingten" data-parent="#accordion">
                            <div class="card-body">
                                No matter how you meet people, finding that special someone is a 'numbers game'.
                                There's no getting around it. You can attend as many events as you like, provided we
                                can have enough of the other gender who you haven't met previously. Each event costs
                                $55.00 + GST.
                            </div>
                        </div>
                    </div>


                    <div class="card">
                        <div class="card-header" id="headingeleven">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseeleven"
                                    aria-expanded="true" aria-controls="collapseeleven">
                                    Will I meet the same people again at another event?
                                </button>
                            </h5>
                        </div>

                        <div id="collapseeleven" class="collapse" aria-labelledby="headingeleven" data-parent="#accordion">
                            <div class="card-body">
                                Seeing a room full of people you've met before isn't going to happen. What would be the
                                point? Anyone who returns to another event risks running into a past participant. If
                                that's the case, I would contact you to make sure that's okay with you. We do take
                                great care not to place you at the same event as a previous match, while seeing a
                                person or two that you have met, but not matched with is usually fine with
                                participants. If there is any problem, we would suggest to one or the other that they
                                return on a different date.
                            </div>
                        </div>
                    </div>



                    <div class="card">
                        <div class="card-header" id="heading12">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapse12"
                                    aria-expanded="true" aria-controls="collapse12">
                                    What if I don't match with anyone?
                                </button>
                            </h5>
                        </div>

                        <div id="collapse12" class="collapse" aria-labelledby="heading12" data-parent="#accordion">
                            <div class="card-body">
                                Sometimes, people don't make a match. We find that when we contact people with the
                                disappointing news, they tend to get down on themselves or the other participants. The
                                truth is that you can't connect with everyone. Maybe the right person just wasn't there
                                that night. For example, I had one fellow who came and didn't make any connections.
                                When I called him, I could sense his disappointment. I talked him into trying again
                                because I truly want people to enjoy the experience and connect with someone.
                                Reluctantly, he did come again and the next time he made three matches!
                            </div>
                        </div>
                    </div>



                    <div class="card">
                        <div class="card-header" id="heading13">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapse13"
                                    aria-expanded="true" aria-controls="collapse13">
                                    How long has Calgary Speed Dating been around?
                                </button>
                            </h5>
                        </div>

                        <div id="collapse13" class="collapse" aria-labelledby="heading13" data-parent="#accordion">
                            <div class="card-body">
                                Calgary Speed Dating was founded in January 2001. We were Calgary's first speed dating
                                company. We have provided continuous service to Calgary's singles ever since. Our
                                success can be attributed to our personalized, friendly service and our commitment to
                                deliver what we promise to Calgary singles.
                            </div>
                        </div>
                    </div>


                    <div class="card">
                        <div class="card-header" id="heading14">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapse14"
                                    aria-expanded="true" aria-controls="collapse14">
                                    It seems so much easier attend speed dating with a friend. Why should I go alone?
                                </button>
                            </h5>
                        </div>

                        <div id="collapse14" class="collapse" aria-labelledby="heading14" data-parent="#accordion">
                            <div class="card-body">
                                While there's nothing preventing friends from coming to speed dating events together, I
                                would recommend coming solo. One of the biggest complaints I hear from men is that
                                groups of women at some single's event huddle together, making them unapproachable. It
                                is easier to chat with comfortable friends rather than converse with new people. Get
                                out of your comfort zone. Also, there is no competition with a friend for the same
                                attendees. At least do not attend with friends who have similar tastes as you.

                                Here are some tips on what to do when you go by yourself and how to have the best time:
                                Come with the purpose of having a wonderful night, no matter what the outcome the next
                                day. Come without any expectations other than to have a great night out and meet a good
                                group of people. Think of the people you sit across from as good conversation and go
                                out on coffee dates. Back off from expectations of meeting someone special that night.
                                Decide you're going to go out and do something different and have fun with it. If you
                                meet someone special, consider it a bonus, but don't go looking for it. You'll feel
                                more relaxed and appear more comfortable, which will increase your chances.
                            </div>
                        </div>
                    </div>

                    {{-- Next --}}
                    <div class="card">
                        <div class="card-header" id="heading15">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapse15"
                                    aria-expanded="true" aria-controls="collapse15">
                                    What if I'm nervous?
                                </button>
                            </h5>
                        </div>

                        <div id="collapse15" class="collapse" aria-labelledby="heading15" data-parent="#accordion">
                            <div class="card-body">
                                Remember that everyone attending is feeling the same thing as you. Everyone is there,
                                like you, to meet someone and maybe make a connection. Keep telling yourself you can do
                                this. Tell yourself, "I'm, good enough. I'm smart enough. And doggonit, people like
                                me". ....Stuart Smalley. Take a deep breath and walk into the room with confidence and
                                a smile! People will be drawn to your positive energy. Before the event, order a
                                beverage and read the profiles. Reading profiles gives you something to do if there's a
                                short lull in the conversation. Introduce yourself and consider that other people may
                                also be shy and nervous. Someone has to make the first move. Women should not leave it
                                all up to the man to initiate. Everyone is in this together.
                            </div>
                        </div>
                    </div>



                    <div class="card">
                        <div class="card-header" id="heading16">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapse16"
                                    aria-expanded="true" aria-controls="collapse16">
                                    7 minutes can feel like a long time. What questions should I ask? What should I
                                    say?
                                </button>
                            </h5>
                        </div>

                        <div id="collapse16" class="collapse" aria-labelledby="heading16" data-parent="#accordion">
                            <div class="card-body">
                                Do not come to an event with great expectations and wedding plans. Those who do best
                                have no expectations. They are relaxed and tend to put other people at ease making them
                                more approachable. Think Coffee Date. Formulate some ideas of what you might ask others
                                when there is a lull in the conversation. It's best not to ask, "Do you come to these
                                things often?" or "What happened to your last relationship?". This type of question is
                                loaded. Ask about things that are more specific nature to that person. Ask open ended
                                questions. What do they like to do when they're not working? Have they travelled?
                                Remember that good conversation is give and take. Refer to the Profile for common
                                ground. Never come with a shopping list of questions, especially on paper. NO ONE wants
                                to be interrogated.<br>

                                Here are a few suggested harmless questions to start conversation:<br>
                                What do you do for fun?<br>
                                Where are you from?<br>
                                What brought you to Calgary?<br>
                                Tell me about your favourite pastime?<br>
                                What is your favourite restaurant in Calgary?<br>
                            </div>
                        </div>
                    </div>


                    <div class="card">
                        <div class="card-header" id="heading17">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapse17"
                                    aria-expanded="true" aria-controls="collapse17">
                                    How should I dress for the event?
                                </button>
                            </h5>
                        </div>

                        <div id="collapse17" class="collapse" aria-labelledby="heading17" data-parent="#accordion">
                            <div class="card-body">
                                Dress as though you're going on a first date - because you are! Dress for different
                                temperatures. It might be cool when you first arrive, so wear something nice that can
                                easily be removed when things warm up. Wearing an outdoor coat is like wearing armour.
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" id="heading18">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapse18"
                                    aria-expanded="true" aria-controls="collapse18">
                                    What do I get for $55.00?
                                </button>
                            </h5>
                        </div>

                        <div id="collapse18" class="collapse" aria-labelledby="heading18" data-parent="#accordion">
                            <div class="card-body">
                                A full evening of meeting new people, great, hearty appetizers and matches sent out the
                                next day. It is an amount similar to what you might spend at a restaurant or on a night
                                out.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>

{{-- Polices--}}
<section id="faq" class="pt-5">
    <div class="container">
        <div class="row ">
            <div class="col-sm-12">
                <h2 class="p-0 mb-4 section-title">Policies:</h2>
            </div>
        </div>
        <hr>
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
                    <h3>Policy on Privacy &amp; Refund</h3>
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

{{-- End Upcoming --}}
@endsection
