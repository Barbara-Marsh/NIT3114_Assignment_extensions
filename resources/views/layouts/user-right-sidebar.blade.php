@section('user-right-sidebar')
    @if(isset(Auth::user()->subscription->name))
        <h2>Your invoices</h2>
        <a href="{{ route('user.invoices') }}" class="btn btn-default btn-margin-top" id="invoice-btn">View Your Invoices</a>
    @endif

@show