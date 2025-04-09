@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Invoice Details - {{ $invoice['invoice_number'] }}</h2>

    {{-- 👤 Customer Details --}}
    <p><strong>Customer:</strong> {{ $invoice['customer_name'] }}</p>
    <p><strong>Date:</strong> {{ $invoice['date'] }}</p>
    <p><strong>Status:</strong> {{ $invoice['status'] }}</p>
    <p><strong>Total:</strong> Ksh{{ number_format($invoice['total'], 2) }}</p>

    {{-- 🧾 New Fields from Zoho --}}
    <p><strong>Pin:</strong> {{ $invoice['cf_pin'] ?? 'N/A' }}</p>
 
    <h3>Line Items</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Item Name</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Rate</th>
                <th>Total</th>
                <th>HS Code</th> {{-- ✅ New column --}}
                <th>Reference Number</th>
                <th>Invoice Url</th> {{-- ✅ New column --}}
            </tr>
        </thead>
        <tbody>
            @foreach($invoice['line_items'] as $item)
            <tr>
                <td>{{ $item['name'] }}</td>
                <td>{{ $item['description'] }}</td>
                <td>{{ $item['quantity'] }}</td>
                <td>Ksh{{ number_format($item['rate'], 2) }}</td>
                <td>Ksh{{ number_format($item['item_total'], 2) }}</td>
                <td>{{ $item['hsn_or_sac'] ?? 'N/A' }}</td> {{-- ✅ HS Code --}}
                <td>{{ $item['reference_number'] ?? 'N/A' }}</td>
                <td>{{ $item['invoice_url'] ?? 'N/A' }}</td> {{-- ✅ VAT Number --}}
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- ✅ Edit Button --}}
    <a href="{{ route('invoices.edit', $invoice['invoice_id']) }}" class="btn btn-primary">
        Edit Invoice
    </a>

    <a href="{{ route('invoices.list') }}" class="btn btn-secondary">Back to Invoices</a>
</div>
@endsection
