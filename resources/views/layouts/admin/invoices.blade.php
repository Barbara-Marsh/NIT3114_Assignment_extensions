@extends('../master')

@section('title')
    Create Invoices
@endsection

@section('content-header')
    <div class="row content-header">
        <div class="col-md-12">
            <h1>Create New Invoices</h1>
        </div>
    </div>
@endsection

@section('content')
    <div class="row ">
        <div class="col-md-8 col-md-offset-2">
            <h2>Subscriptions Near to Ending</h2>
        </div>
        <div class="col-md-8 col-md-offset-2">
            <table class="table table-responsive table-bordered">
                <tr>
                    <th>id</th>
                    <th>User</th>
                    <th>Plan</th>
                    <th>Update Plan</th>
                    <th>Price</th>
                    <th>Starts at</th>
                    <th>Ends at</th>
                    <th></th>
                </tr>
            @foreach($subscriptions as $subscription)
                <tr>
                    <td>{{ $subscription->id }}</td>
                    <td>{{ $subscription->user_id }}</td>
                    <td>{{ $subscription->plan_id }}</td>
                    <td>{{ $subscription->update_plan_id }}</td>
                    <td>{{ $subscription->price }}</td>
                    <td>{{ $subscription->starts_at }}</td>
                    <td>{{ $subscription->ends_at }}</td>
                    <td><a href="" class="btn btn-default">Create Invoice</a></td>
                </tr>
            @endforeach
            </table>
        </div>
    </div>
@endsection