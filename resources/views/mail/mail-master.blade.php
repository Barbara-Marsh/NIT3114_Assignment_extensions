<!DOCTYPE HTML>
<html lang="{{ config('app.locale') }}">
<head>
    <title>Email from Australian Weather Services</title>
    <link rel="stylesheet" href="{{asset('css/mail.css')}}">
</head>
<body>
@yield('content-header')

@yield('content')

<p>Regards,</p>
<p>The Australian Weather Services team</p>
<p>aws@example.com</p>
</body>
</html>