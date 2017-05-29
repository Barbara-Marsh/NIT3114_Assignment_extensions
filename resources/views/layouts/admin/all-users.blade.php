@extends('../master')

@section('title')
    Admin Console
@endsection

@section('content-header')
    <div class="row content-header">
        <div class="col-md-12">
            <h1>All Users</h1>
        </div>
    </div>
@endsection

@section('content')
    <div class="row ">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Plan</th>
                <th>Subscribed to email</th>
                <th>Subscribed to third party offers</th>
                <th>Banned</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user['name'] }}</td>
                <td>{{ $user['email'] }}</td>
                <td>{{ $user['plan'] ?? "" }}</td>
                <td>@php echo boolval($user['subscribed_to_newsletter']) ? 'TRUE' : '' @endphp</td>
                <td>@php echo boolval($user['third_party_offers']) ? 'TRUE' : '' @endphp</td>
                <td>@php echo boolval($user['is_banned']) ? 'TRUE' : '' @endphp</td>
                <td>
                    <form action="{{ Route('admin.ban-user') }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <input type="hidden" name="user_id" value="{{$user['id']}}">
                        <button class="btn btn-danger">Ban User</button>
                    </form>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection