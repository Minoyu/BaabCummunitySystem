@component('mail::message')
# Hello, {{$username}}!
## We have received your Reset Password request.

If you confirm that this is your own operation, you can click the button below to reset the password.

@component('mail::button', ['url' => $link])
Confirm To Reset
@endcomponent

This link must be kept properly, effective within 10 minutes. If you didn't operate it, please ignore this email.
<br>
<br>
Thanks,<br>
{{ config('app.name') }}

@component('mail::subcopy')
    If you’re having trouble clicking the "Confirm To Reset" button, copy and paste the URL below
    into your web browser: [{{ $link }}]({{ $link }})
@endcomponent
@endcomponent
