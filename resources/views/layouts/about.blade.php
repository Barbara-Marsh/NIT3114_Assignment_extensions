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
            <p><strong>Instructions</strong></p>
            <p>To access the system as an admin user, the email address for the account is <strong>admin@example.com</strong> and the password is <strong>admin</strong>.</p><br>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <p><strong>Assumptions:</strong></p>
            <ul>
                <li>User can only subscribe to 1 plan</li>
                <li>Displayed prices include GST of 10%</li>
                <li>Upon first registering, invoice price will be plan price, but for further invoices an administrator can take discounts from the total or remove tax</li>
                <li>No function to delete subscriptions, instead give status of 'cancelled' so historical information can be kept</li>
                <li>Invoices are created for the previous month, not billed in advance</li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
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
                <li>id (pk): integer</li>
                <li>name: string</li>
                <li>email: email</li>
                <li>password: string</li>
                <li>subscribed_to_newsletter: boolean</li>
                <li>third_party_offers: boolean</li>
                <li>card_name: string</li>
                <li>card_number: integer, 12 digits</li>
                <li>expiry: date</li>
                <li>csv: integer, 3 digits</li>
                <li>admin: boolean</li>
            </ul>
        </div>
        <div class="col-md-3">
            <p><strong>Plans Table</strong></p>
            <ul>
                <li>id (pk): integer</li>
                <li>name: string</li>
                <li>features: string</li>
                <li>price: double</li>
                <li>is_active: boolean</li>
            </ul>
        </div>
        <div class="col-md-3">
            <p><strong>Subscriptions Table</strong></p>
            <ul>
                <li>id (pk): integer</li>
                <li>user_id (fk): integer</li>
                <li>plan_id (fk): integer</li>
                <li>renew_plan_id (fk): integer</li>
                <li>price: double</li>
                <li>starts_at: date</li>
                <li>ends_at: date</li>
                <li>status: enum</li>
            </ul>
        </div>
        <div class="col-md-3">
            <p><strong>Invoices Table</strong></p>
            <ul>
                <li>id (pk): integer</li>
                <li>subscription_id (fk): integer</li>
                <li>price: double</li>
                <li>discount: double</li>
                <li>date: date</li>
                <li>ignore_taxes: boolean</li>
            </ul>
        </div>
    </div>
@endsection
