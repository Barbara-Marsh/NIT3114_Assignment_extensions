<h1>Welcome</h1>

<p>Dear {{ $user['name'] }},</p>

<p>Thank you for registering with us.</p>

<p>You can view your invoices at any time by going to <a href="{{ route('user.index') }}">your profile.</a></p>