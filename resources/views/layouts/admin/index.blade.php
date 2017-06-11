@extends('../master')

@section('title')
    Admin Console
@endsection

@section('content-header')
    <div class="row content-header">
        <div class="col-md-12">
            <h1>Admin Console</h1>
        </div>
    </div>
@endsection

@section('content')
    <div class="row ">
        <div class="container statistics-container col-md-10 col-md-offset-1">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="content-header admin-h2">System Statistics</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-md-offset-2">
                    <p><strong>Number of subscribers per plan:</strong></p>
                    <ul>
                    @foreach($subscribers_plan as $plan)
                        <li><strong>{{ $plan['name'] }}: </strong>{{ $plan['count'] }}</li>
                    @endforeach
                    </ul>
                </div>
                <div class="col-md-4">
                    <p><strong>Number of new subscribers this month: </strong>{{ $new_subscribers }}</p>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <h2 class="content-header admin-h2">System Tasks</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-md-offset-4 text-center admin-btn">
                    <a href="{{ Route('admin.view-users') }}" class="btn btn-default">Ban/Restore Users</a>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <h2 class="content-header  admin-h2">Reports</h2>
                </div>
                <div class="col-md-4 text-center">
                    <a href="{{ Route('admin.invoices') }}" class="btn btn-default">View invoices for past month</a>
                </div>
                <div class="col-md-4 text-center admin-btn">
                    <a href="{{ Route('admin.subscriptions') }}" class="btn btn-default">View subscriptions for past month</a>
                </div>
                <div class="col-md-4 text-center">
                    <a href="{{ Route('admin.charges') }}" class="btn btn-default">View charges for past month</a>
                </div>
            </div>
            <div class="row"></div>
        </div>
    </div>
@endsection