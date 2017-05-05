@inject('total','App\Http\Controllers\InvoiceController)
@section('user-right-sidebar')
    <h2>Your invoices</h2>
    <p>Your current balance is ${{ number_format($total->getTotalOwing(), 2) }}</p>
    <a href="" class="btn btn-default btn-margin-top">View unpaid invoices</a>
    <a href="" class="btn btn-default btn-margin-top">View all invoices</a>
@show