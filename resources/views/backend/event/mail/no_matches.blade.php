@component('mail::message')
# Hi {{$user->full_name}},

Thank you so much for attending the speed dating event last night!
We hope you enjoyed yourself. You were chosen by <span class="color:blue">{{$likes}} </span> people, but unfortunately,
there wasn’t a match with the people you chose. Please don't take it personally.
This really is a 'numbers game'. The more people you meet, the more likely you'll meet that special someone.


If you ever want to come again you would be more than welcome!
One of the great things about Calgary Speed Dating is that the group of people attending will always be different.

Sincerely,<br>
All of us at<br>
{{ config('app.name') }}<br>
403-219-3283<br>
[Like Us on Facebook – Singles Info and Tips](https://www.facebook.com/bookmarks/pages#!/pages/Calgary-Speed-Dating-Single-Calgarians-YYC-Singles-10-years-old/188077887886362 "Like Us on Facebook – Singles Info and Tips")<br>

Some email servers consider the word “dating” a SPAM word, sending emails directly to SPAM folders or simply deleting them.
Add info@calgaryspeeddating.com to your address book to keep our emails in your Inbox.
@endcomponent