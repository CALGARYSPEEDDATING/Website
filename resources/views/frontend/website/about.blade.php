@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.frontend.contact.box_title'))

@section('content')
<div id="banner" class="about_page">
        <section class=" pt-5 pb-5">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="breadcrumb-text text-center">
                            <h1 class="text-white title-main"> About Us </h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

<section class="pt-5 pb-5">
        <section id="faq" class="">
                <div class="container">
                    <div class="row ">
                        <div class="col-sm-12">
                            <h2 class="p-0 mb-4 section-title">About Us:</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="question_answer mb-5">
                                
                                <p style="font-weight:bold">We are the leader in speed dating in Calgary and the preferred choice of Calgarians looking to meet someone special to date. Our events have become the go to destination for people tired of online dating and seriously want that human interaction and connection. Think of us as offline dating – a place you go to and would likely forget your phone because of all the fun you are having.
                                        How our events work: At Calgary Speed Dating, we get together an average of 12 men and 12 women for fun, 7-minute dates - you decide if there's a match! Each participant has a dating card. You mark down who you'd like to see and everyone else does the same. If you say "yes" to the same people who say "yes" to you, it's a match and you get each other's contact information usually the same night. It's fun. It's simple. Come and see for yourself!
                                        Attention to detail, that's what Calgary Speed Dating is all about!</p>
            
                                <ul>

                                    <li>Events with even numbers of men and women (Once in a while, there may be 1 more of a gender but you'll never come and find 9 women and 3 men attending.)</li>
                                    <li>We keep track of every event you come to so that you don't meet a lot of the same people at future events</li>
                                    <li>Participant profiles are provided with general answers about interests, dream vacations and passions, etc. Great ice breakers!</li>
                                    <li>We take id to confirm that participants fit within the ages promised</li>
                                    <li>We serve delicious appetizers</li>
                                    <li>The rounds are 7 minutes - long enough to find out if there's a spark and quick enough to move on if you're not connecting</li>
                                    <li>We’ve been serving Calgary Singles since 2001</li>
                                    <li>We are the leader in speed dating in Calgary and the preferred choice of Calgarians looking to meet someone special to date. Our events have become the go to destination for people tired of online dating and seriously want that human interaction and connection. Think of us as offline dating – a place you go to and would likely forget your phone because of all the fun you are having.</li>
                                </ul>
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
                {{-- <p>If you need a list of things to do on a date WorldDatingGuides can help.</p>
                <a target="_blank" href="https://worlddatingguides.com/calgary/">https://worlddatingguides.com/calgary/</a> --}}
            </section>
    </section>
    <section id="featured_events" class="pt-5 pb-5 bg-grey">
        @include('frontend.includes.featured') 
   
     </section>
  
@endsection
