@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Zoho Items</h2>

    <!-- Create Item Button -->
    <a href="{{ route('items.create') }}" class="btn btn-success mb-3">
        + Create New Item
    </a>

    <!-- Items Table -->
    <table class="table">
        <thead>
            <tr>
                <th>Item Name</th>
                <th>Rate</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr>
                <td>{{ $item['name'] }}</td>
                <td>Ksh{{ $item['rate'] }}</td>
                <td>
                    <a href="{{ route('items.show', $item['item_id']) }}" class="btn btn-info">
                        View
                    </a>
                    <a href="{{ route('items.edit', $item['item_id']) }}" class="btn btn-warning">
                        Edit
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
