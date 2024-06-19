@component('mail::message')

Dear {{$user->full_name}}

We are sorry to see you go, but we have received your request to delete your profile from our speed dating platform. This email is to confirm that your account and all associated personal information has been permanently deleted from our system.
<br><br>
Please note that this action cannot be undone. If you wish to use our service again in the future, you will need to create a new profile.
<br><br>
If you have any concerns or questions, please do not hesitate to contact us. We value your feedback and would appreciate hearing from you about your experience with our service.
<br><br>
Thank you for using Calgary Speed Dating. We wish you all the best in your dating endeavors.
<br>

Best regards,<br>
All of us at,<br>
{{ config('app.name') }}
@endcomponent
