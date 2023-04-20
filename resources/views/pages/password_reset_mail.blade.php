<x-mail::message>
Hello {{$user->name}},

<?php 
    $url = 'http://localhost/e-commerce/public/reset_password/' . $user->password_verification_code;
?>

<x-mail::button :url="$url">
Click here to reset your password
</x-mail::button>
<p>Or copy paste the following link on your web browser to reset your password</p>
<p><a href="{{$url}}">{{$url}}</a></p>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
