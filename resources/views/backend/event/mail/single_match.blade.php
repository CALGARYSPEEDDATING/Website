@component('mail::message')
# Hi {{$user->full_name}},

We hope you enjoyed your speed dating event last night. It was a pleasure having you join us!

Here is your match:

## **{{$match->first_name}}:  {{$match->email}}  {{$match->phone}}**

Good luck! Please keep us in the loop should your match turn out to be your special someone.

<span style="color:red">**Note:**</span> Your match also has your contact information.

Sincerely,<br>
All of us at<br>
{{ config('app.name') }}<br>
403-219-3283<br>
[Like Us on Facebook – Singles Info and Tips](https://www.facebook.com/bookmarks/pages#!/pages/Calgary-Speed-Dating-Single-Calgarians-YYC-Singles-10-years-old/188077887886362 "Like Us on Facebook – Singles Info and Tips")<br>

Some email servers consider the word “dating” a SPAM word, sending emails directly to SPAM folders or simply deleting them.
Add info@calgaryspeeddating.com to your address book to keep our emails in your Inbox.
@endcomponent
