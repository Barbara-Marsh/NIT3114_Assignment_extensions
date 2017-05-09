Dear {{ $user->name }},

Here is your latest invoice.

Invoice No: {{ $invoice->id }}
Date:       {{ $invoice->date }}
Total:      ${{ $invoice->price }}

You can view your invoices at any time by going to <a href="{{ route('user.index') }}">your profile.</a>