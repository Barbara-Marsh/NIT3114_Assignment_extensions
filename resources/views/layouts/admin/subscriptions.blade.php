@extends('../master')

@section('title')
    Admin Console
@endsection

@section('content-header')
    <div class="row content-header">
        <div class="col-md-12">
            <h1>Subscription Report</h1>
            <h2>Subscriptions for past month</h2>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
        @foreach($subscriptions as $subscription)
        <table class="table table-bordered table-responsive table-transparent-background">
            <thead>
            <tr>
                <th>Subscription #</th>
                <th>Customer Name</th>
                <th>Plan Name</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{ $subscription['id'] }}</td>
                <td>{{ $subscription['customer_name'] ?? "" }}</td>
                <td>{{ $subscription['plan_name'] }}</td>
                <td>{{ $subscription['status'] }}</td>
            </tr>
            </tbody>
            <thead>
            <tr>
                <th>Created on</th>
                <th>Amount</th>
                <th>Current Period Start</th>
                <th>Current Period End</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{ $subscription['created'] }}</td>
                <td>$@php echo number_format($subscription['amount']/100,2) @endphp</td>
                <td>{{ $subscription['current_period_start'] }}</td>
                <td>{{ $subscription['current_period_end'] }}</td>
            </tr>
            </tbody>
        </table>
        @endforeach
        </div>
    </div>
@endsection