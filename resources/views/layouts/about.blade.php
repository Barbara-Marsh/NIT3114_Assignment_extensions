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
            <p>Admin user: <strong>admin@example.com</strong> with password <strong>admin</strong>.</p>
            <p>User with Open plan: <strong>joe@example.com</strong> with password: <strong>joe</strong>.</p>
            <p>User with Basic plan: <strong>barb@example.com</strong> with password: <strong>barb</strong>.</p>
            <p>User with Pro plan: <strong>sally@example.com</strong> with password: <strong>sally</strong>.</p>
            <p>Banned user: <strong>john@example.com</strong> with password <strong>john</strong></p><br>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <p><strong>Assumptions:</strong></p>
            <ul>
                <li>User can only subscribe to 1 plan</li>
                <li>Displayed prices include GST of 10%</li>
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
                <li>admin: boolean</li>
                <li>stripe_id: string</li>
                <li>card_brand: string</li>
                <li>card_last_four: string</li>
                <li>trial_ends_at: string</li>
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
                <li>number_of_cities: integer (this variable for complete implementation where open plan doesn't have access to all cities)</li>
                <li>is_active: boolean</li>
                <li>stripe_id: string</li>
                <li>created_at: timestamp</li>
                <li>updated_at: timestamp</li>
            </ul>
        </div>
        <div class="col-md-3">
            <p><strong>Subscriptions Table</strong></p>
            <ul>
                <li>id (pk): integer</li>
                <li>user_id (fk): integer</li>
                <li>name: string</li>
                <li>stripe_id: string</li>
                <li>stripe_plan: string</li>
                <li>quantity: integer</li>
                <li>trial_ends_at: timestamp</li>
                <li>ends_at: timestamp</li>
                <li>created_at: timestamp</li>
                <li>updated_at: timestamp</li>
            </ul>
        </div>
        <div class="col-md-3">
            <p><strong>Cities Table</strong></p>
            <ul>
                <li>id (pk): integer</li>
                <li>name: string</li>
                <li>openweathermap_id: string</li>
                <li>created_at: timestamp</li>
                <li>updated_at: timestamp</li>
            </ul>
        </div>
        </div>
    <div class="row">
        <br>
        <div class="col-md-12 text-justify">
            <p>Because I used checkboxes for the newsletter settings form, the built-in Laravel validation didn't work. If the boxes are checked, the value in the $request variable is 'on', so I couldn't validate it as a boolean. However, the way my update_newsletter_settings and store_newsletter_settings functions are written ensures that the values must be boolean.</p>
        </div>
    </div>
@endsection
