@component('mail::message')
# Introduction

Hello This Planet Dev.

@component('mail::button', ['url' => 'http://localhost:8000/password-reset?token='.$token])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent