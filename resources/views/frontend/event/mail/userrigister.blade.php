@component('mail::message')
# Thank you for confirming your attendance with Calgary Speed Dating!

Hi {{$user->full_name}}

Just one more step to get ready for the event! Please click 'reply', &nbsp;
answer the questions below and return this email
ASAP but by 10 p.m. the night before the event at the latest.
The profile is a jumping off point for conversation. You are not 'selling yourself' or 'shopping for a commodity' as
you might in an internet dating profile. It is more general. Keep your answers short and in point form. It's about
skimming, not reading. Answer only the questions you want to answer. Please keep it to about 50 words. If you choose
not to create a Profile, your profile will read 'International Man/Woman of Mystery'.

<span style="color:red">
**Now that you are registered, log into your profile and answer the conversation starter questionnaire in your profile.
The conversation helper helps you get to know the person across from you in a fun way.
At the event, the males get the females answers and females get the males” Go ahead and have fun with it.**
</span>

**Cost:** {{$user->profile->gender == 1 ? $event->price_female : $event->price_male }} + GST ({{$user->profile->gender == 1 ? $event->price_female + $event->price_female * 0.05 :$event->price_male + $event->price_male * 0.05 }} total) per event.<br>
**Event:** {{$event->title}}<br>
**Date:**  {{ date("F j, Y", strtotime($event->start_datetime)) }}, 6:15pm (6:30 start. Events can run as late as 10:15.)<br>
**Location:**  {{ $event->address }}. Plenty of Parking!<br>

**Dress:**  Dressy-casual. Dress as though you are going out on a first date. You are!<br>
**Additional info:**  Participants can be up to 2 years outside the specified age group. To protect the integrity of the events, we confirm the ages of participants - bring valid id with birth date, e.g., driver's licence. This info is kept on file. It won't be shared with or sold to any other companies or individuals.


Best regards,<br>
All of us at<br>
{{ config('app.name') }}<br>
403-219-3283
@endcomponent
