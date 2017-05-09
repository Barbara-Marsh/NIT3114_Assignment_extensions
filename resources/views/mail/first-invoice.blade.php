<?php //dd($user) ?>

<h1>Welcome</h1>

<p>Dear {{ $user['name'] }},</p>

<p>Thank you for registering with us. Here is your first invoice.</p>

<p>
    Invoice No: {{ $invoice['id'] }}<br>
    Date:       {{ $invoice['date'] }}<br>
    Total:      ${{ $invoice['price'] }}
</p>

<p>You can view your invoices at any time by going to <a href="{{ route('user.index') }}">your profile.</a></p>