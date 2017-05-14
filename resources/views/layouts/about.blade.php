@extends('../master')

@section('title')
    About
@endsection

@section('content-header')
    <div class="row content-header">
        <div class="col-md-12">
            <h1>About this application</h1>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 text-justify">
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
                <li>created_at: timestamp</li>
                <li>updated_at: timestamp</li>
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
                <li>created_at: timestamp</li>
                <li>updated_at: timestamp</li>
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
                <li>created_at: timestamp</li>
                <li>updated_at: timestamp</li>
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
                <li>created_at: timestamp</li>
                <li>updated_at: timestamp</li>
            </ul>
        </div>
    </div>
    <div class="row">
        <br>
        <div class="col-md-12 text-justify">
            <p>I chose to add additional fields to the User table rather than have a number of 1 to 1 relationships to simplify the code and limit the number of database calls required to get the information. As all contact with users is currently via email, I chose not to gather physical address details for the database but this could be easily changed in a future iteration of the project if required.</p>
            <p>Currently the credit card information is being stored insecurely without encryption. I considered that this would be adequate for this prototype because future improvements will be adding a payment gateway that should avoid this problem.</p>
            <p>I designed a registration process that is presented to the user over several small forms rather than one large one. The first form is currently the default Laravel registration form, but if address details are required, they would be added here. On the next page the user selects the plan they want to subscribe to. If they choose Open, they are directed to the newsletter settings page, but if they choose one of the paid plans they are directed to the billing details plan first. I decided to include the plan selection in the registration process because I thought it would be pointless having registered users who were not subscribed to a plan.</p>
            <p>Because I used checkboxes for the newsletter settings form, the built-in Laravel validation didn't work. If the boxes are checked, the value in the $request variable is 'on', so I couldn't validate it as a boolean. However, the way my update_newsletter_settings and store_newsletter_settings functions are written ensures that the values must be boolean.</p>
            <p>As invoices are sent to new users upon subscribing and to renewing users, I thought two different emails should be sent. This made it necessary to include a new variable $type with the request to the Mail constructor function to distinguish the two categories and use different blade templates accordingly. An additional type "cancelled" was created so users who cancel their plan get a farewell message.</p>
        </div>
    </div>
@endsection
