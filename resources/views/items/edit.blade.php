@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="my-4">Edit Item</h2>

    <!-- Edit Item Form -->
    <div class="card shadow-sm p-4 mb-4">
        <div class="card-body">
            <form action="{{ route('items.update', $item['item_id']) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Item Name -->
                <div class="form-group">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $item['name']) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Item Rate -->
                <div class="form-group">
                    <label for="rate" class="form-label">Rate</label>
                    <input type="number" id="rate" name="rate" class="form-control @error('rate') is-invalid @enderror" value="{{ old('rate', $item['rate']) }}" required>
                    @error('rate')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Item Description -->
                <div class="form-group">
                    <label for="description" class="form-label">Description</label>
                    <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" rows="4">{{ old('description', $item['description'] ?? '') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update Item</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
