@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="my-4">Item Details</h2>

    <div class="card shadow-sm p-4 mb-4">
        <div class="card-body">
            <h5 class="card-title">Item Information</h5>

            <p><strong>Name:</strong> {{ $item['name'] }}</p>
            <p><strong>Rate:</strong> {{ $item['rate'] }}</p>
            <p><strong>Description:</strong> {{ $item['description'] ?? 'N/A' }}</p>
            <p><strong>Hs_code:</strong> {{ $item['cf_hs_code'] ?? 'N/A' }}</p>
            <p><strong>Status:</strong> {{ $item['status'] }}</p>

            <div class="d-flex justify-content-between">
                <a href="{{ route('items.edit', $item['item_id']) }}" class="btn btn-warning">Edit</a>
                <a href="{{ route('items.index') }}" class="btn btn-secondary">Back to Items</a>
            </div>
        </div>
    </div>
</div>
@endsection
