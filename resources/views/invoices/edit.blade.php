@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Invoice - {{ $invoice['invoice_number'] }}</h2>
    
    <form action="{{ route('invoices.update', $invoice['invoice_id']) }}" method="POST">
        @csrf
        @method('PUT') {{-- Zoho doesn't support PUT, so we use POST instead --}}
        
        <div class="mb-3">
            <label for="customer_id" class="form-label">Customer ID</label>
            <input type="text" class="form-control" id="customer_id" name="customer_id" value="{{ $invoice['customer_id'] }}" required>
        </div>

        <div class="mb-3">
            <label for="invoice_number" class="form-label">Invoice Number</label>
            <input type="text" class="form-control" id="invoice_number" name="invoice_number" value="{{ $invoice['invoice_number'] }}" required>
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">Invoice Date</label>
            <input type="date" class="form-control" id="date" name="date" value="{{ $invoice['date'] }}" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-control" id="status" name="status">
                <option value="draft" {{ $invoice['status'] == 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="sent" {{ $invoice['status'] == 'sent' ? 'selected' : '' }}>Sent</option>
                <option value="paid" {{ $invoice['status'] == 'paid' ? 'selected' : '' }}>Paid</option>
            </select>
        </div>

        <h3>Line Items</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Item Name</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Rate</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($invoice['line_items'] as $index => $item)
                <tr>
                    <td>
                        <input type="text" name="line_items[{{ $index }}][name]" class="form-control" value="{{ $item['name'] }}" required>
                    </td>
                    <td>
                        <input type="text" name="line_items[{{ $index }}][description]" class="form-control" value="{{ $item['description'] }}">
                    </td>
                    <td>
                        <input type="number" name="line_items[{{ $index }}][quantity]" class="form-control" value="{{ $item['quantity'] }}" required>
                    </td>
                    <td>
                        <input type="number" step="0.01" name="line_items[{{ $index }}][rate]" class="form-control" value="{{ $item['rate'] }}" required>
                    </td>
                    <td>Ksh{{ number_format($item['item_total'], 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <button type="submit" class="btn btn-success">Update Invoice</button>
        <a href="{{ route('invoices.list') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
