@section('user-sidebar')
    <h2>Edit your settings</h2>
    <a href="{{ Route('user.edit_newsletter') }}" class="btn btn-info btn-margin-top">Change Newsletter<br>Settings</a>
    <a href="{{ Route('user.edit_card') }}" class="btn btn-info btn-margin-top">Change Billing Details</a>
    @if(isset(Auth::user()->activeSubscription()->name))
        <h2>Your invoices</h2>
        <a href="{{ route('user.invoices') }}" class="btn btn-info btn-margin-top" id="invoice-btn">View Your Invoices</a>
    @endif
@show
