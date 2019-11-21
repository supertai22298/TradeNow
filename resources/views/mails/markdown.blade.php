@component('mail::message')
# Introduction

{!! $data['description'] !!}

@component('mail::button', ['url' => route('/')])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
