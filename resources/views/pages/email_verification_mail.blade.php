<x-mail::message>
Hello {{$user->name}},

<?php 
    $url = 'http://localhost/e-commerce/public/verify_email/' . $user->email_verification_code;
?>

<x-mail::button :url="$url">
Click here to verify your email address
</x-mail::button>
<p>Or copy paste the following link on your web browser to verify your email address</p>
<p><a href="{{$url}}">{{$url}}</a></p>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message> 
