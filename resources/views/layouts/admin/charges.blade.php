@extends('../master')

@section('title')
    Admin Console
@endsection

@section('content-header')
    <div class="row content-header">
        <div class="col-md-12">
            <h1>Charges Report</h1>
            <h2>Charges for past month</h2>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
        @foreach($charges as $charge)
        <table class="table table-bordered table-responsive table-transparent-background charge-table">
            <thead>
            <tr>
                <th>Charge #</th>
                <th class="thin-column">Type</th>
                <th class="thin-column">Paid</th>
                <th class="thin-column">Status</th>
                <th class="thin-column">Date</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{ $charge['id'] }}</td>
                <td>{{ $charge['object'] }}</td>
                <td>{{ $charge['paid'] }}</td>
                <td>{{ $charge['status'] }}</td>
                <td>{{ $charge['created'] }}</td>
            </tr>
            </tbody>
            <thead>
            <tr>
                <th>For Invoice</th>
                <th>Amount</th>
                <th>Refund Amount</th>

                <th>Customer Name</th>
                <th>Customer Email</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{ $charge['invoice_id'] }}</td>
                <td>$@php echo number_format($charge['amount']/100,2) @endphp</td>
                <td>$@php echo number_format($charge['amount_refunded']/100,2) @endphp</td>

                <td>{{ $charge['customer_name'] ?? "" }}</td>
                <td>{{ $charge['customer_email'] ?? "" }}</td>
            </tr>
            </tbody>
        </table>
        @endforeach
        </div>
    </div>
@endsection