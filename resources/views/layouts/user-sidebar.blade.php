@section('user-sidebar')
    <h3>Edit your settings</h3>
    <a href="{{ Route('user.edit_subscription', ['id' => $user['id']]) }}" class="btn btn-default btn-margin-top">Change Plan</a><br>
    <a href="{{ Route('user.edit_newsletter', ['id' => $user['id']]) }}" class="btn btn-default btn-margin-top">Change Email Settings</a>
    <a href="{{ route('user.edit_billing', ['id' => $user['id']]) }}" class="btn btn-default btn-margin-top">Change Billing Details</a>
@show