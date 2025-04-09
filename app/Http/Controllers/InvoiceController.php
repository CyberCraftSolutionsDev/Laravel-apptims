<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Services\ZohoService; // Import ZohoService

class InvoiceController extends Controller
{
    private $zohoToken;
    private $zohoBaseUrl;
    private $organizationId;

    public function __construct()
    {
        $this->zohoToken = ZohoService::getAccessToken(); // Use ZohoService to get the token
        $this->organizationId = '882235066'; // Set organization ID
        $this->zohoBaseUrl = "https://www.zohoapis.com/books/v3/invoices"; // Zoho API URL
    }

    // ✅ Fetch list of invoices
    public function index()
    {
        $response = Http::withHeaders([
            'Authorization' => "Zoho-oauthtoken {$this->zohoToken}",
        ])->get("{$this->zohoBaseUrl}?organization_id={$this->organizationId}");

        $data = $response->json();
        
        Log::info('Invoices retrieved: ', $data['invoices'] ?? []);

        return view('invoices.index', ['invoices' => $data['invoices'] ?? []]);
    }

    // 1️⃣ GET a single invoice
    public function show($id)
    {
        $response = Http::withHeaders([
            'Authorization' => "Zoho-oauthtoken {$this->zohoToken}",
        ])->get("{$this->zohoBaseUrl}/{$id}?organization_id={$this->organizationId}");
    
        $data = $response->json();
    
        Log::info('Invoice Full Response: ', $data); // 🔍 log everything
    
        if (!isset($data['invoice'])) {
            return redirect()->route('invoices.list')->with('error', 'Invoice not found');
        }
    
        return view('invoices.details', ['invoice' => $data['invoice']]);
    }
    

    // 2️⃣ Create a new invoice
    public function create()
    {
        return view('invoices.create'); // Ensure 'invoices.create' exists
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|string|max:255',
            'invoice_number' => 'required|string|max:255',
        ]);
    
        $data = [
            'customer_id' => $request->customer_id,
            'invoice_number' => $request->invoice_number,
        ];
    
        $response = Http::withHeaders([
            'Authorization' => "Zoho-oauthtoken {$this->zohoToken}",
        ])->post("{$this->zohoBaseUrl}?organization_id={$this->organizationId}", $data);
    
        if ($response->failed()) {
            return redirect()->back()->with('error', 'Failed to create invoice.');
        }
    
        return redirect()->route('invoices.list')->with('success', 'Invoice created successfully!');
    }
    
    // 3️⃣ Edit invoice page
    public function edit($id)
    {
        Log::info("Editing invoice with ID: {$id}");
    
        $response = Http::withHeaders([
            'Authorization' => "Zoho-oauthtoken {$this->zohoToken}",
        ])->get("{$this->zohoBaseUrl}/{$id}?organization_id={$this->organizationId}");
    
        $data = $response->json();
    
        if (!isset($data['invoice'])) {
            Log::error("Invoice with ID {$id} not found in API response");
            return redirect()->route('invoices.index')->with('error', 'Invoice not found');
        }
    
        return view('invoices.edit', ['invoice' => $data['invoice']]);
    }

    // 4️⃣ Update invoice
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'customer_name' => 'required|string|max:255',
            'invoice_number' => 'required|string|max:255',
            'date' => 'required|date',
            'status' => 'required|string',
        ]);
    
        // ✅ Send PUT request to Zoho API
        $response = Http::withHeaders([
            'Authorization' => "Zoho-oauthtoken {$this->zohoToken}",
            'Content-Type' => 'application/json',
        ])->put("{$this->zohoBaseUrl}/invoices/{$id}?organization_id={$this->organizationId}", $validatedData);
    
        if ($response->failed()) {
            return redirect()->back()->with('error', 'Failed to update invoice.');
        }
    
        return redirect()->route('invoices.list')->with('success', 'Invoice updated successfully!');
    }
    

    

    // 5️⃣ Delete an invoice
    public function destroy($id)
    {
        $response = Http::withHeaders([
            'Authorization' => "Zoho-oauthtoken {$this->zohoToken}",
        ])->delete("{$this->zohoBaseUrl}/{$id}?organization_id={$this->organizationId}");

        return redirect()->route('invoices.index')->with('success', 'Invoice deleted successfully!');
    }
}
