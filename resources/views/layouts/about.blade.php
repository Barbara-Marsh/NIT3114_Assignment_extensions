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
        <li>Displayed prices include GST of 10%</li>
        <li>Upon first registering, invoice price will be plan price. For further invoices an administrator can take discounts from the total or remove tax</li>
        <li>No function to delete subscriptions, instead give status of 'cancelled' so historical information can be kept</li>
        <li>As invoices are sent to new users upon subscribing and to renewing users, two different emails are required to be sent. This made it necessary to include a new variable $type with the request to the Mail __constructor function to distinguish the two categories and use different blade templates accordingly.</li>
        <li></li>
    </ul>
@endsection
