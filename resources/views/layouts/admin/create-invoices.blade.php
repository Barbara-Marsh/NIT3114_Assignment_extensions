@extends('../master')

@section('title')
    Create Invoices
@endsection

@section('content-header')
    <div class="row content-header">
        <div class="col-md-12">
            <h1>Create New Invoice</h1>
        </div>
    </div>
@endsection

@section('content')
    <div class="row ">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">New Invoice</div>
                <div class="panel-body">
                    <p>Subscription Details</p>
                    <table class="table table-bordered table-responsive">
                        <tr>
                            <th>Subscription ID</th>
                            <th>User ID</th>
                            <th>Plan ID</th>
                            <th>Renew Plan ID<br>(if present)</th>
                            <th>Price</th>
                            <th>Starts at</th>
                            <th>Ends at</th>
                        </tr>
                        <tr>
                            <td>{{ $subscription->id }}</td>
                            <td>{{ $subscription->user_id }}</td>
                            <td>{{ $subscription->plan_id }}</td>
                            <td>{{ $subscription->renew_plan_id }}</td>
                            <td>{{ $subscription->price }}</td>
                            <td>{{ $subscription->starts_at }}</td>
                            <td>{{ $subscription->ends_at }}</td>
                        </tr>
                    </table>
                    <p>Invoice Form</p>
                    <form action="{{ route('admin.store_invoice') }}" method="post" class="form-horizontal" role="form">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="col-md-2">
                                <label for="subscription_id" class="control-label">Subscript Id: </label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="subscription_id" value="{{ $subscription->id }}" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-2">
                                <label for="date" class="control-label">Date: </label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="date" value="{{ $date }}" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-2">
                                <label for="price" class="control-label">Price: </label>
                            </div>
                            <div class="col-md-10">
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    <input type="text" class="form-control" name="price" value="{{ $subscription->price }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-2">
                                <label for="discount" class="control-label">Discount: </label>
                            </div>
                            <div class="col-md-10">
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    <input type="text" class="form-control" name="discount" value="{{ old('discount') }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-2">
                                <label for="ignore_taxes" class="control-label">Ignore Taxes?</label>
                            </div>
                            <div class="col-md-10">
                                <input type="checkbox" class="big-checkbox" name="ignore_taxes">
                            </div>
                        </div>
                        <p>
                            <a href="{{ route('admin.index') }}" class="btn btn-default btn-margin-top">Return to Console</a>
                            <button class="btn btn-default btn-margin-top">Create Invoice</button>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection