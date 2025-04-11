@extends('layouts.app')

@section('content')
    <h2>Credit Notes</h2>

    <a href="{{ route('creditnotes.create') }}" class="btn btn-primary">Create Credit Note</a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Pin</th>
                <th>Date</th>
                <th>Total</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($creditnotes as $creditnote)
                <tr>
                    <td>{{ $creditnote['creditnote_id'] }}</td>
                    <td>{{ $creditnote['customer_name'] }}</td>
                    <td style="padding: 10px;">{{ $creditnote['cf_pin'] ?? 'N/A' }}</td>
                    <td>{{ \Carbon\Carbon::parse($creditnote['date'])->format('d-m-Y') }}</td>
                    <td>{{ $creditnote['total'] }}</td>
                    <td>
                        <a href="{{ route('creditnotes.show', $creditnote['creditnote_id']) }}" class="btn btn-info">View</a>
                        <a href="{{ route('creditnotes.edit', $creditnote['creditnote_id']) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('creditnotes.destroy', $creditnote['creditnote_id']) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
