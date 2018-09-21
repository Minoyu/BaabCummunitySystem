@component('mail::message')
    # Hello, {{$username}}!
    ## We have received your Reset Password request.

    If you confirm that this is your own operation, you can click the button below to reset the password.

    @component('mail::panel')
        @component('mail::button', ['url' => $link])
            Confirm To Reset
        @endcomponent
        {{$link}}
    @endcomponent

    This link must be kept properly, effective within 10 minutes. If you don't operate it, please ignore this email.
    <br>
    <br>
    Thanks,<br>
    {{ config('app.name') }}
@endcomponent