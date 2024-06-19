
@if(!empty($upcoming_events))
<div class="container">
    <div class="row text-center">
        <div class="col-sm-12">
            <h2 class="p-0 mb-4 section-title">Upcomming Event</h2>
        </div>
    </div>

    <div class="card col-sm-12 shadow bg-dark pb-5 border-0">
        <div class="row">
            <div class="col-12 text-center d-block d-sm-block d-md-none d-lg-none xl-none">
                <img src="{{$upcoming_events->main_image }}" alt="{{$upcoming_events->title }}">
            </div>
            <div class="col-md-8 pl-5 count_down_info_contain">
                <div class="info_count_down pt-5 positive-relative">
                    <h2 class="text-white d-inline">
                        Next<br>
                        <strong>Upcoming Event</strong>
                    </h2>
                    <div class="counter">
                        <p id="countdown" class="float-right d-inline"></p>
                        <div class="d-flex timer-title">
                            <h6>Days</h6>
                            <h6>Hours</h6>
                            <h6>Minutes</h6>
                            <h6>Seconds</h6>
                        </div>
                    </div>
                </div>
                <div class="info_upcoming_date d-flex">
                    <h2 class="text-white upcomming_event_date">
                        {{date("j", strtotime($upcoming_events->start_datetime))}}
                    </h2>
                    <h6 class="so-small text-white ml-3 mt-1">
                        {{date("F", strtotime($upcoming_events->start_datetime))}}<br>
                        {{date("Y", strtotime($upcoming_events->start_datetime))}}
                    </h6>
                </div>


                
                <div class="detail_upcoming_event pt-5">
                <h6 class="text-white"><a href="{{route('frontend.event.show', $upcoming_events)}}">{{$upcoming_events->title }}</a>
                    </h6>
                <p class="text-white"><i class="fas fa-circle mr-1"></i> Time: {{date("g:i a", strtotime($upcoming_events->start_datetime))}}</p>
                <p class="text-white"><i class="fas fa-circle mr-1"></i> Location: {{$upcoming_events->address }}</p>
                </div>
            </div>
            <div class="col-sm-4 pr-0 d-none d-sm-none d-md-block d-lg-block d-xl-block">
                <img src="{{$upcoming_events->main_image }}" alt="{{$upcoming_events->title }}">
            </div>
        </div>
    </div>

</div>
@php
 $date = date("M j, Y h:i:s", strtotime($upcoming_events->start_datetime));   
@endphp

@push('after-scripts')
<script>
    // CountDown

    // Set the date we're counting down to
    var countDownDate = new Date("{{$date}}").getTime();

    // Update the count down every 1 second
    var x = setInterval(function () {

        // Get todays date and time
        var now = new Date().getTime();
        var upcomingdate = "{{strtotime($upcoming_events->start_datetime)}}";
        console.log(upcomingdate);
        // Find the distance between now and the count down date
        var distance = countDownDate - now;
      

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Display the result in the element with id="demo"

        document.getElementById("countdown").innerHTML = "<span>" + days + "</span>" + "<span>" + hours +
            "</span>" +
            "<span>" + minutes + "</span>" + "<span>" + seconds + "</span>";


        // If the count down is finished, write some text 
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("countdown").innerHTML = "EXPIRED";
        }
    }, 1000);
</script>

@endpush
@endif