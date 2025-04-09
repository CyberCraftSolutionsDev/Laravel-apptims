@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Invoices List</h2>

    <!-- Create Invoice Button -->
    <a href="{{ route('invoices.create') }}" class="btn btn-success mb-3">
    + Create New Invoice 
</a>



    <table class="table">
        <thead>
            <tr>
                <th>Invoice Number</th>
                <th>Customer Name</th>
                <th>Date</th>
                <th>Status</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoices as $invoice)
            <tr>
                <td>{{ $invoice['invoice_number'] }}</td>
                <td>{{ $invoice['customer_name'] }}</td>
                <td>{{ $invoice['date'] }}</td>
                <td>{{ $invoice['status'] }}</td>
                <td>Ksh{{ number_format($invoice['total'], 2) }}</td>
                <td>
                    <a href="{{ route('invoices.details', $invoice['invoice_id']) }}" class="btn btn-primary">
                        View Details
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
