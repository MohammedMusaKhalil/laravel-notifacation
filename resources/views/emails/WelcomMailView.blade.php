<x-mail::message>
# Introduction

Welcom {{ $user->nmae }} you just registers in our app with the folowing e-mail{{ $user->email }}

<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
