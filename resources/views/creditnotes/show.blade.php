@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Credit Note Details - {{ $creditnote['creditnote_number'] }}</h2>

    {{-- 👤 Customer Details --}}
    <p><strong>Customer:</strong> {{ $creditnote['customer_name'] }}</p>
    <p><strong>Date:</strong> {{ $creditnote['date'] }}</p>
    <p><strong>Status:</strong> {{ $creditnote['status'] }}</p>
    <p><strong>Total:</strong> Ksh{{ number_format($creditnote['total'], 2) }}</p>

    {{-- 🧾 New Fields from Zoho --}}
    <p><strong>Pin:</strong> {{ $contact['cf_pin'] ?? 'N/A' }}</p>
    
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
                <th>Credit Note Url</th> {{-- ✅ New column --}}
            </tr>
        </thead>
        <tbody>
            @foreach($creditnote['line_items'] as $item)
            <tr>
                <td>{{ $item['name'] }}</td>
                <td>{{ $item['description'] }}</td>
                <td>{{ $item['quantity'] }}</td>
                <td>Ksh{{ number_format($item['rate'], 2) }}</td>
                <td>Ksh{{ number_format($item['item_total'], 2) }}</td>
                <td>{{ $item['cf_hs_code'] ?? 'N/A' }}</td> {{-- ✅ HS Code --}}
                <td>{{ $item['reference_number'] ?? 'N/A' }}</td>
                <td>{{ $item['creditnote_url'] ?? 'N/A' }}</td> {{-- ✅ Credit Note URL --}}
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- ✅ Edit Button --}}
    <a href="{{ route('creditnotes.edit', $creditnote['creditnote_id']) }}" class="btn btn-primary">
        Edit Credit Note
    </a>

    <a href="{{ route('creditnotes.index') }}" class="btn btn-secondary">Back to Credit Notes</a>
</div>
@endsection
