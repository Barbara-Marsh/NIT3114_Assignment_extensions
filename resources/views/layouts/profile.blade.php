@extends('master')

@section('title')
    Profile
@endsection

@section('content-header')
    <div class="row content-header">
        <div class="col-md-12">
            <h1>User Profile</h1>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-3">
            @include('layouts.user-sidebar')
        </div>
        <div class="col-md-9">
            <h2>Current settings</h2>
            <table>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Current Plan</th>
                    <th>Newsletter Subscription</th>
                    <th>Third Party Offers</th>
                </tr>
                <tr>
                    <td>{{ $user['name'] }}</td>
                    <td>{{ $user['email'] }}</td>
                    <td></td>
                    <td>
                        <input type="checkbox"
                        @if ($user['subscription'] == true)
                            checked="checked"
                        @endif
                        >
                    </td>
                    <td>
                        <input type="checkbox"
                        @if ($user['offers'] == true)
                           checked="checked"
                        @endif
                        >
                    </td>
                </tr>
            </table>
        </div>
    </div>
@endsection
