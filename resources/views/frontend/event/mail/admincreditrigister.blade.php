@component('mail::message')
# New Event Registrations Alert

Hi CalgarySpeedDating Administrator,

<div style="width:800px">
        @component('mail::table')
        | |  |
        | ------------- | ------------- |
        | **Event Title**     | {{$event->title}}     |
        | **Event Cost**     | $ {{$user->profile->gender == 1 ? $event->price_female : $event->price_male }} |
        | **Event Date**     | {{ date("F j, Y", strtotime($event->start_datetime)) }} at {{date("g:i a", strtotime($event->start_datetime))}}    |
        | **Name**   | {{$user->full_name}}    |
        | **Email**   | {{$user->email}}    |
        | **Phone Number**   | {{$user->phone}}    |
        | **Refrence Number** | 'Use Credit'  |
        @endcomponent
        </div>




Thanks,<br>
{{ config('app.name') }}
@endcomponent
