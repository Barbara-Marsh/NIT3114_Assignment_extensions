@section('user-sidebar')
    <h2>Edit your settings</h2>
    <a href="{{ Route('user.edit_newsletter') }}" class="btn btn-default btn-margin-top">Change Email Settings</a>
    <a href="{{ Route('user.edit_card') }}" class="btn btn-default btn-margin-top">Change Billing Details</a>
@show
