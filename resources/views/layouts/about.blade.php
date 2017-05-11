@extends('../master')

@section('title')
    About
@endsection

@section('content-header')
    <div class="row content-header">
        <div class="col-md-12">
            <h1>About this app</h1>
        </div>
    </div>
@endsection

@section('content')
    <p></p>
    <p>Assumptions:</p>
    <ul>
        <li>User can only subscribe to 1 plan</li>
        <li>Upon first registering, invoice price will be plan price. For further invoices an administrator can take discounts from the total</li>
    </ul>
@endsection
