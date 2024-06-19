@component('mail::message')
# Hi {{$user->full_name}},

We hope you enjoyed your speed dating event last night. Unfortunately, there wasn’t a match with the people you chose. Please don't take it personally.
This really is a 'numbers game'. The more people you meet, the more likely you'll meet that special someone.


Thank you for joining us tonight and should you ever want to try it again you would be more than welcome.
One of the great things about Calgary Speed Dating is that the group of people attending will always be different.

Sincerely,<br>
All of us at<br>
{{ config('app.name') }}<br>
403-219-3283<br>
[Like Us on Facebook – Singles Info and Tips](https://www.facebook.com/bookmarks/pages#!/pages/Calgary-Speed-Dating-Single-Calgarians-YYC-Singles-10-years-old/188077887886362 "Like Us on Facebook – Singles Info and Tips")<br>

Some email servers consider the word “dating” a SPAM word, sending emails directly to SPAM folders or simply deleting them.
Add info@calgaryspeeddating.com to your address book to keep our emails in your Inbox.
@endcomponent
