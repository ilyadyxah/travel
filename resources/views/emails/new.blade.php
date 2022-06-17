@component('mail::message')
    <p>{{$greeting}}</p>
    <p>Пользователь {{ Str::ucfirst($user->name )}} поделился своим публичным профилем.</p>
    @component('mail::button', ['url' => $user->public_link])
        Посмотреть
    @endcomponent
    <p>Комментарий пользователя: {{ Str::ucfirst($message->message) }}</p>
    <p>{{ $salutation }}</p>
    <p>{{config('app.name')}}</p>

@endcomponent
