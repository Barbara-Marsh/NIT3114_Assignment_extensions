<p>Dear {{ $user->name }},</p>

<p>Here is your latest invoice.</p>

<p>
    Invoice No: {{ $invoice->id }}<br>
    Date:       {{ $invoice->date }}<br>
    Total:      ${{ $invoice->price }}
</p>

<p>You can view your invoices at any time by going to <a href="{{ route('user.index') }}">your profile.</a></p>