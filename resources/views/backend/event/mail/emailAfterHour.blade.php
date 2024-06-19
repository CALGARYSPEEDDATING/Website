@component('mail::message')
# Hello {{$user->full_name}},

{!!$emailAfterHour->description!!} <a href="https://www.google.com/maps/place/Calgary+Speed+Dating%F0%9F%91%AB/@51.4931793,-112.6647852,7z/data=!3m1!4b1!4m6!3m5!1s0x53717180d1b03f1f:0x21631cdaa110b384!8m2!3d51.4931794!4d-112.6647852!16s%2Fg%2F11gtbldld6" style="display:inline">here</a><br><br>

Thank you for your support, and we wish you the best of luck with your matches!

Sincerely,<br>
All of us at<br>
{{ config('app.name') }}<br>
403-219-3283<br>
[Like Us on Facebook – Singles Info and Tips](https://www.facebook.com/bookmarks/pages#!/pages/Calgary-Speed-Dating-Single-Calgarians-YYC-Singles-10-years-old/188077887886362 "Like Us on Facebook – Singles Info and Tips")<br>

Some email servers consider the word “dating” a SPAM word, sending emails directly to SPAM folders or simply deleting them.
Add info@calgaryspeeddating.com to your address book to keep our emails in your Inbox.
@endcomponent
