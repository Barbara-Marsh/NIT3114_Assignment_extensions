@extends('../master')

@section('title')
    Admin Console
@endsection

@section('content-header')
    <div class="row content-header">
        <div class="col-md-12">
            <h1>Invoices Report</h1>
            <h2>Invoices for past month</h2>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
        @foreach($invoices as $invoice)
        <table class="table table-bordered table-responsive table-transparent-background table-top">
            <thead>
            <tr>
                <th>Invoice #</th>
                <th>Customer ID</th>
                <th>Customer Name</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{ $invoice['id'] }}</td>
                <td>{{ $invoice['customer_id'] }}</td>
                <td>{{ $invoice['customer_name'] ?? "" }}</td>
            </tr>
            </tbody>
        </table>
        <table class="table table-bordered table-responsive table-transparent-background table-bottom">
            <thead>
            <tr>
                <th>Plan</th>
                <th class="three-x-width">Description</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Amount</th>
                <th>Total Amount</th>
            </tr>
            </thead>
            <tbody>
                @foreach($invoice['lines'] as $line)
                    <tr>
                        <td>{{ $line['plan_name'] ?? "" }}</td>
                        <td class="three-x-width">{{ $line['description'] ?? "" }}</td>
                        <td>{{ $line['start'] ?? "" }}</td>
                        <td>{{ $line['end'] ?? "" }}</td>
                        <td>$@php echo number_format($line['amount']/100,2) @endphp</td>
                        <td>$@php echo number_format($line['total_amount']/100,2) @endphp</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @endforeach
        </div>
    </div>
@endsection