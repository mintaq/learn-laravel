@component('mail::message')
# Someone has posted a blog post

Let's see it.

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
