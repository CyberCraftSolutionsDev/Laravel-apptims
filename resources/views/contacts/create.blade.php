@extends('layouts.app')

@section('content')
    <h2 style="text-align: center; color: #007bff; margin-bottom: 20px;">Create Contact</h2>

    <form method="POST" action="{{ route('contacts.store') }}" 
          style="max-width: 500px; margin: 0 auto; padding: 20px; background: white; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
        @csrf

     

        <div style="margin-bottom: 15px;">
            <label for="contact_name" style="display: block; font-weight: bold; margin-bottom: 5px;">Contact Name:</label>
            <input type="text" id="contact_name" name="contact_name" value="{{ old('contact_name') }}" placeholder="Enter contact name" required
                   style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; font-size: 16px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="email" style="display: block; font-weight: bold; margin-bottom: 5px;">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Enter email address" required
                   style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; font-size: 16px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="phone" style="display: block; font-weight: bold; margin-bottom: 5px;">Phone:</label>
            <input type="text" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Enter phone number"
                   style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; font-size: 16px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="company_name" style="display: block; font-weight: bold; margin-bottom: 5px;">Company Name:</label>
            <input type="text" id="company_name" name="company_name" value="{{ old('company_name') }}" placeholder="Enter company name" required
                   style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; font-size: 16px;">
        </div>

        <button type="submit" style="width: 100%; background-color: #007bff; color: white; padding: 10px; border: none; border-radius: 5px; font-size: 16px; cursor: pointer;">
            Save
        </button>
    </form>
@endsection
