@extends('layouts.app')

@section('content')
    <h2 style="text-align: center; margin-bottom: 20px;">Edit Customer</h2>

    <form method="POST" action="{{ route('contacts.update', $contact['id']) }}" 
          style="max-width: 500px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 5px; background-color: #f9f9f9;">
        @csrf
        @method('PUT')

        <label for="id" style="display: block; margin-bottom: 5px;">ID</label>
        <input type="text" id="id" name="id" value="{{ $contact['id'] ?? '' }}" 
               readonly style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px; background-color: #e9ecef;">

        <label for="name" style="display: block; margin-bottom: 5px;">Name</label>
        <input type="text" id="contact_name" name="name" value="{{ $contact['contact_name'] ?? '' }}" 
               required style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px;">

        <label for="email" style="display: block; margin-bottom: 5px;">Email</label>
        <input type="email" id="email" name="email" value="{{ $contact['email'] ?? '' }}" 
               required style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px;">

        <label for="phone" style="display: block; margin-bottom: 5px;">Phone</label>
        <input type="text" id="phone" name="phone" value="{{ $contact['phone'] ?? '' }}" 
               style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px;">

        <button type="submit" 
                style="width: 100%; padding: 10px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;">
            Update
        </button>
    </form>
@endsection
