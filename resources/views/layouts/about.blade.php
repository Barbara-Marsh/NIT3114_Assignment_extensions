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
    <div class="row">
        <div class="col-md-12">
            <p><strong>Assumptions:</strong></p>
            <ul>
                <li>User can only subscribe to 1 plan</li>
                <li>Displayed prices include GST of 10%</li>
                <li>Upon first registering, invoice price will be plan price, but for further invoices an administrator can take discounts from the total or remove tax</li>
                <li>No function to delete subscriptions, instead give status of 'cancelled' so historical information can be kept</li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <p>To access the system as an admin user, the email is <strong>admin@example.com</strong> and the password is <strong>admin</strong>.</p>
            <p>Because I used checkboxes for the newsletter settings form, the built-in Laravel validation didn't work. If the boxes are checked, the value in the $request variable is 'on', so I couldn't validate it as a boolean. However, the way my update_newsletter_settings and store_newsletter_settings functions are written ensures that the values must be boolean.</p>
            <p>As invoices are sent to new users upon subscribing and to renewing users, two different emails are required to be sent. This made it necessary to include a new variable $type with the request to the Mail constructor function to distinguish the two categories and use different blade templates accordingly.</p>
        </div>
    </div>
    <div class="row content-header">
        <div class="col-md-12">
            <h2>Database design</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <p><strong>Users Table</strong></p>
            <ul>
                <li></li>
            </ul>
        </div>
        <div class="col-md-3">
            <p><strong>Plans Table</strong></p>
            <ul>
                <li></li>
            </ul>
        </div>
        <div class="col-md-3">
            <p><strong>Subscriptions Table</strong></p>
            <ul>
                <li></li>
            </ul>
        </div>
        <div class="col-md-3">
            <p><strong>Invoices Table</strong></p>
            <il>
                <li></li>
            </il>
        </div>
    </div>
@endsection
