@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Credit Note - {{ $creditnote['creditnote_number'] }}</h2>

    {{-- 👤 Customer Details --}}
    <form action="{{ route('creditnotes.update', $creditnote['creditnote_id']) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="customer_id">Customer ID:</label>
            <input type="text" class="form-control" name="customer_id" value="{{ old('customer_id', $creditnote['customer_id']) }}" required>
        </div>

        <div class="form-group">
            <label for="date">Date:</label>
            <input type="date" class="form-control" name="date" value="{{ old('date', $creditnote['date']) }}" required>
        </div>

        <div class="form-group">
            <label for="line_items">Line Items:</label>
            <textarea class="form-control" name="line_items" required>{{ old('line_items', json_encode($creditnote['line_items'])) }}</textarea>
        </div>

        {{-- Add more fields as required --}}
        
        <button type="submit" class="btn btn-primary">Update Credit Note</button>
        <a href="{{ route('creditnotes.index') }}" class="btn btn-secondary">Back to Credit Notes</a>
    </form>
</div>
@endsection
