@component('mail::message')
# Dear {{$user->full_name}},
Your registration was cancelled for the following event:
## {{$event->title}} {{$event->id}}
When: {{date("F j, Y", strtotime($event->start_datetime))}}
Where: {{$event->address}}

## Your Registration Details
Price: $ {{$user->profile->gender == 1 ? $event->price_female : $event->price_male }} <br>
First name: {{$user->first_name}}<br>
Last name: {{$user->last_name}}

Sincerely,<br>
All of us at<br>
{{ config('app.name') }}<br>
403-219-3283<br>
[Like Us on Facebook – Singles Info and Tips](https://www.facebook.com/bookmarks/pages#!/pages/Calgary-Speed-Dating-Single-Calgarians-YYC-Singles-10-years-old/188077887886362 "Like Us on Facebook – Singles Info and Tips")<br>

Some email servers consider the word “dating” a SPAM word, sending emails directly to SPAM folders or simply deleting them.
Add info@calgaryspeeddating.com to your address book to keep our emails in your Inbox.
@endcomponent
