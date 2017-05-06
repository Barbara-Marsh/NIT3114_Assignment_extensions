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
    <div class="row">
        <h2 class="content-header">System Statistics</h2>
        <div class="col-md-4 col-md-offset-2">
            <p><strong>Number of subscribers per plan:</strong></p>
            <p></p>
            <p></p>
            <p></p>
        </div>
        <div class="col-md-4">
            <p><strong>Number of new subscribers this month: </strong>{{ $new_subscribers }}</p>
        </div>
    </div>
@endsection