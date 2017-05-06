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
        <div class="container statistics-container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="content-header">System Statistics</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-md-offset-2">
                    <p><strong>Number of subscribers per plan:</strong></p>
                    <p>&ensp;</p>
                    <p>&ensp;</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Number of new subscribers this month: </strong>{{ $new_subscribers }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-md-offset-2">
                    <p><strong>Number of outstanding invoices: </strong>{{ $outstanding }}</p>
                </div>
                <div class="col-md-4">

                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <h2 class="content-header">System Tasks</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 col-md-offset-2">
                    <a href="" class="btn btn-default">Send Monthly Invoices</a>
                </div>
                <div class="col-md-3>">
                    <a href="" class="btn btn-default">View Outstanding Invoices</a>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <h2 class="content-header">Usage Graphs</h2>
                </div>
            </div>
            <div class="row"></div>
        </div>
    </div>
@endsection