@component('mail::message')
Hi {{$user->full_name}},

You have an upcoming event scheduled for {{ \Carbon\Carbon::parse($event->start_datetime)->format('M d Y')}}  and it looks like you profile is incomplete.

Please use the link below to login and update your profile.

@component('mail::button', ['url' => url('/account')])
Login
@endcomponent

Sincerely,<br>
All of us at<br>
{{ config('app.name') }}<br>
403-219-3283<br>
[Like Us on Facebook – Singles Info and Tips](https://www.facebook.com/bookmarks/pages#!/pages/Calgary-Speed-Dating-Single-Calgarians-YYC-Singles-10-years-old/188077887886362 "Like Us on Facebook – Singles Info and Tips")<br>

Some email servers consider the word “dating” a SPAM word, sending emails directly to SPAM folders or simply deleting them.
Add info@calgaryspeeddating.com to your address book to keep our emails in your Inbox.
@endcomponent
