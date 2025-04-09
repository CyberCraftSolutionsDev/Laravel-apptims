@extends('layouts.app')

@section('content')
    <h2 style="text-align: center; margin-bottom: 20px;">Contacts List</h2>
    <a href="{{ route('contacts.create') }}" style="display: inline-block; margin-bottom: 15px; padding: 10px 15px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;">
        Create Contact
    </a>

    <table style="width: 100%; border-collapse: collapse; border: 1px solid #ddd;">
        <thead>
            <tr style="background-color: #f2f2f2; text-align: left;">
                <th style="padding: 10px; border-bottom: 1px solid #ddd;">ID</th>
                <th style="padding: 10px; border-bottom: 1px solid #ddd;">Name</th>
                <th style="padding: 10px; border-bottom: 1px solid #ddd;">Email</th>
                <th style="padding: 10px; border-bottom: 1px solid #ddd;">Phone</th>
                <th style="padding: 10px; border-bottom: 1px solid #ddd;">Pin</th>
                <th style="padding: 10px; border-bottom: 1px solid #ddd;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $contact)
                <tr style="border-bottom: 1px solid #ddd;">
                    <td style="padding: 10px;">{{ $contact['contact_id'] ?? 'N/A' }}</td>
                    <td style="padding: 10px;">{{ $contact['contact_name'] ?? 'N/A' }}</td>
                   
                    <td style="padding: 10px;">{{ $contact['email'] ?? 'N/A' }}</td>
                   
                    <td style="padding: 10px;">{{ $contact['mobile'] ?? 'N/A' }}</td>
                    <td style="padding: 10px;">{{ $contact['cf_pin'] ?? 'N/A' }}</td>
                    <td style="padding: 10px;">
                        @if (!empty($contact['contact_id']))
                            <a href="{{ route('contacts.edit', ['id' => $contact['contact_id'] ?? 'missing_id']) }}" 
                               style="padding: 5px 10px; background-color: #28a745; color: white; text-decoration: none; border-radius: 3px;">
                               Edit (ID: {{ $contact['contact_id'] ?? 'N/A' }})
                            </a>

                            <form action="{{ route('contacts.destroy', ['id' => $contact['contact_id']]) }}" 
                                  method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="padding: 5px 10px; background-color: #dc3545; color: white; border: none; border-radius: 3px; cursor: pointer;">
                                    Delete
                                </button>
                            </form>
                        @else
                            <span style="color: red;">Invalid Contact</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
