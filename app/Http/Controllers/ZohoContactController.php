<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Services\ZohoService; // Import ZohoService

class ZohoContactController extends Controller
{
    private $zohoToken;
    private $zohoBaseUrl;
    private $organizationId;

    public function __construct()
    {
        $this->zohoToken = ZohoService::getAccessToken(); // Use ZohoService to get the token
        $this->organizationId = '882235066'; // Set organization ID
        $this->zohoBaseUrl = "https://www.zohoapis.com/books/v3/contacts"; // Zoho API URL
    }

    // ✅ Fetch list of contacts
    public function index()
    {
        $response = Http::withHeaders([
            'Authorization' => "Zoho-oauthtoken {$this->zohoToken}",
        ])->get("{$this->zohoBaseUrl}?organization_id={$this->organizationId}");

        $data = $response->json();
        
        Log::info('Contacts retrieved: ', $data['contacts'] ?? []);

        return view('contacts.index', ['contacts' => $data['contacts'] ?? []]);
    }

    // 1️⃣ GET a single contact
    public function show($id)
    {
        $response = Http::withHeaders([
            'Authorization' => "Zoho-oauthtoken {$this->zohoToken}",
        ])->get("{$this->zohoBaseUrl}/{$id}?organization_id={$this->organizationId}");
    
        $data = $response->json();
    
        if (!isset($data['contact'])) {
            return redirect()->route('contacts.index')->with('error', 'Contact not found');
        }
    
        return view('contacts.details', ['contact' => $data['contact']]); // ✅ Render a Blade view
    }
    

    // 2️⃣ Create a new contact
    public function create()
    {
        return view('contacts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'contact_name' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'mobile' => 'required|string|max:255',
        ]);

        $data = [
            'contact_name' => $request->contact_name,
            'company_name' => $request->company_name,
            'email' => $request->email,
            'phone' => $request->phone,
        ];

        $response = Http::withHeaders([
            'Authorization' => "Zoho-oauthtoken {$this->zohoToken}",
        ])->post("{$this->zohoBaseUrl}?organization_id={$this->organizationId}", $data);

        if ($response->failed()) {
            return redirect()->back()->with('error', 'Failed to create contact.');
        }

        return redirect()->route('contacts.list')->with('success', 'Contact created successfully!');
    }

    // 3️⃣ Edit contact page
    public function edit($id)
    {
        Log::info("Editing contact with ID: {$id}");
    
        $response = Http::withHeaders([
            'Authorization' => "Zoho-oauthtoken {$this->zohoToken}",
        ])->get("{$this->zohoBaseUrl}/{$id}?organization_id={$this->organizationId}");
    
        $data = $response->json();
    
        if (!isset($data['contact'])) {
            Log::error("Contact with ID {$id} not found in API response");
            return redirect()->route('contacts.list')->with('error', 'Contact not found');
        }
    
        // Ensure the contact has an ID (use 'contact_id' if 'id' is missing)
        $data['contact']['id'] = $data['contact']['id'] ?? $data['contact']['contact_id'] ?? $id;
    
        return view('contacts.edit', ['contact' => $data['contact']]);
    }
    

    // 4️⃣ Update contact
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'contact_name' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
        ]);
    
        $response = Http::withHeaders([
            'Authorization' => "Zoho-oauthtoken {$this->zohoToken}",
            'Content-Type' => 'application/json',
        ])->put("{$this->zohoBaseUrl}/{$id}?organization_id={$this->organizationId}", $validatedData);
    
        if ($response->failed()) {
            return redirect()->back()->with('error', 'Failed to update contact.');
        }
    
        return redirect()->route('contacts.index')->with('success', 'Contact updated successfully!');
    }

    // 5️⃣ Delete a contact
    public function destroy($id)
    {
        $response = Http::withHeaders([
            'Authorization' => "Zoho-oauthtoken {$this->zohoToken}",
        ])->delete("{$this->zohoBaseUrl}/{$id}?organization_id={$this->organizationId}");

        return redirect()->route('contacts.list')->with('success', 'Contact deleted successfully!');
    }
}
