@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create New Invoice</h2>

    <form action="{{ route('invoices.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="invoice_number" class="form-label">Invoice Number</label>
            <input type="text" class="form-control" id="invoice_number" name="invoice_number" required>
        </div>
        <div class="mb-3">
            <label for="customer_id" class="form-label">Customer ID</label>
            <input type="text" class="form-control" id="customer_id" name="customer_id" required>
        </div>
        <button type="submit" class="btn btn-primary">Create Invoice</button>
    </form>
</div>
@endsection
