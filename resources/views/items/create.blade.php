@extends('layouts.app')

@section('title', 'Create Item')

@section('content')
<div class="container">
    <h1 class="my-4">Create New Item</h1>

    <!-- Show success or error message if any -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Create Item Form -->
    <form action="{{ route('items.store') }}" method="POST">
        @csrf

        <div class="card shadow-sm p-4 mb-4">
            <div class="form-group">
                <label for="name">Item Name</label>
                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="rate">Rate</label>
                <input type="number" id="rate" name="rate" class="form-control @error('rate') is-invalid @enderror" value="{{ old('rate') }}" required>
                @error('rate')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Description (optional)</label>
                <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="unit">Unit</label>
                <input type="text" id="unit" name="unit" class="form-control @error('unit') is-invalid @enderror" value="{{ old('unit') }}" required>
                @error('unit')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Create Item</button>
            </div>
        </div>
    </form>
</div>
@endsection
