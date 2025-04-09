<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Services\ZohoService;

class ZohoItemController extends Controller
{
    private $zohoToken;
    private $organizationId;
    private $zohoBaseUrl;

    public function __construct()
    {
        $this->zohoToken = ZohoService::getAccessToken();
        $this->organizationId = env('ZOHO_ORGANIZATION_ID');
        $this->zohoBaseUrl = "https://www.zohoapis.com/books/v3/items";
    }

    // ✅ Fetch all items
    public function index()
    {
        $response = Http::withHeaders([
            'Authorization' => "Zoho-oauthtoken {$this->zohoToken}",
        ])->get("{$this->zohoBaseUrl}?organization_id={$this->organizationId}");

        $data = $response->json();
        Log::info('Items retrieved: ', $data['items'] ?? []);

        return view('items.index', ['items' => $data['items'] ?? []]);
    }

    // ✅ Show single item
    public function show($id)
    {
        $response = Http::withHeaders([
            'Authorization' => "Zoho-oauthtoken {$this->zohoToken}",
        ])->get("{$this->zohoBaseUrl}/{$id}?organization_id={$this->organizationId}");

        $data = $response->json();

        if (!isset($data['item'])) {
            return redirect()->route('items.index')->with('error', 'Item not found.');
        }

        return view('items.show', ['item' => $data['item']]);
    }

    // ✅ Show create item form
    public function create()
    {
        return view('items.create');
    }

    // ✅ Store new item
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'rate' => 'required|numeric',
            'description' => 'nullable|string',
            'unit' => 'required|string',
            // Add other fields as required
        ]);

        $response = Http::withHeaders([
            'Authorization' => "Zoho-oauthtoken {$this->zohoToken}",
            'Content-Type' => 'application/json',
        ])->post("{$this->zohoBaseUrl}?organization_id={$this->organizationId}", $validatedData);

        if ($response->failed()) {
            Log::error('Failed to create item', $response->json());
            return redirect()->back()->with('error', 'Failed to create item.');
        }

        return redirect()->route('items.index')->with('success', 'Item created successfully!');
    }

    // ✅ Edit item form
    public function edit($id)
    {
        Log::info("Editing item with ID: {$id}");

        $response = Http::withHeaders([
            'Authorization' => "Zoho-oauthtoken {$this->zohoToken}",
        ])->get("{$this->zohoBaseUrl}/{$id}?organization_id={$this->organizationId}");

        $data = $response->json();

        if (!isset($data['item'])) {
            Log::error("Item with ID {$id} not found.");
            return redirect()->route('items.index')->with('error', 'Item not found.');
        }

        return view('items.edit', ['item' => $data['item']]);
    }

    // ✅ Update item
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'rate' => 'required|numeric',
            'description' => 'nullable|string',
            'unit' => 'required|string',
            // Add other fields as required
        ]);

        $response = Http::withHeaders([
            'Authorization' => "Zoho-oauthtoken {$this->zohoToken}",
            'Content-Type' => 'application/json',
        ])->put("{$this->zohoBaseUrl}/{$id}?organization_id={$this->organizationId}", $validatedData);

        if ($response->failed()) {
            Log::error('Failed to update item', $response->json());
            return redirect()->back()->with('error', 'Failed to update item.');
        }

        return redirect()->route('items.index')->with('success', 'Item updated successfully!');
    }

    // ✅ Optional: Delete item (if needed in the future)
    public function destroy($id)
    {
        $response = Http::withHeaders([
            'Authorization' => "Zoho-oauthtoken {$this->zohoToken}",
        ])->delete("{$this->zohoBaseUrl}/{$id}?organization_id={$this->organizationId}");

        if ($response->failed()) {
            return redirect()->route('items.index')->with('error', 'Failed to delete item.');
        }

        return redirect()->route('items.index')->with('success', 'Item deleted successfully!');
    }
}
