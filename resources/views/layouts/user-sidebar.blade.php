<?php
use App\Subscription;
use App\Plan;

if (!isset($subscription)) {
    $subscription = Subscription::where('user_id', $user['id'])->first()->toArray();
    $plan_id = (int)$subscription['plan_id'];
    $plan = Plan::where('id', $plan_id)->first()->toArray();
}
?>

@section('user-sidebar')
    <h2>Edit your settings</h2>
    <a href="{{ Route('user.edit_subscription', ['id' => $user['id']]) }}" class="btn btn-default btn-margin-top">Change Plan</a><br>
    <a href="{{ Route('user.edit_newsletter', ['id' => $user['id']]) }}" class="btn btn-default btn-margin-top">Change Email Settings</a>
    @if ($plan['name'] !== 'Open')
    <a href="{{ route('user.edit_billing', ['id' => $user['id']]) }}" class="btn btn-default btn-margin-top">Change Billing Details</a>
    @endif
@show
