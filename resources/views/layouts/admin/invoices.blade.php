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
            <table class="table table-responsive table-bordered table-hover">
                <tr>
                    <th>Subscription ID</th>
                    <th>User ID</th>
                    <th>Plan ID</th>
                    <th>Renew Plan ID<br>(if present)</th>
                    <th>Price</th>
                    <th>Starts at</th>
                    <th>Ends at</th>
                    <th></th>
                </tr>
            @for($x = 0; $x < count($subscriptions); $x++)
                <form action="{{ route('admin.create_invoice') }}" method="get">
                    {{ csrf_field() }}
                    <tr>
                        <td>{{ $subscriptions[$x]->id }}</td>
                        <td>{{ $subscriptions[$x]->user_id }}</td>
                        <td>{{ $subscriptions[$x]->plan_id }}</td>
                        <td>{{ $subscriptions[$x]->renew_plan_id }}</td>
                        <td>{{ $subscriptions[$x]->price }}</td>
                        <td>{{ $subscriptions[$x]->starts_at }}</td>
                        <td>{{ $subscriptions[$x]->ends_at }}</td>
                        <input type="hidden" value="{{ $subscriptions[$x] }}" name="subscription">
                        <td><button class="btn btn-default">Create Invoice</button></td>
                    </tr>
                </form>
            @endfor
            </table>
            <p><a href="{{ route('admin.index') }}" class="btn btn-default">Return to Admin Console</a></p>
        </div>
    </div>
@endsection