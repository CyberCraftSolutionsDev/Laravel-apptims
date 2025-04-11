<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Services\ZohoService;

class ZohoCreditNoteController extends Controller
{
    private $zohoToken;
    private $organizationId;
    private $zohoBaseUrl;

    public function __construct()
    {
        $this->zohoToken = ZohoService::getAccessToken();
        $this->organizationId = env('ZOHO_ORGANIZATION_ID'); // Getting from .env for flexibility
        $this->zohoBaseUrl = "https://www.zohoapis.com/books/v3/creditnotes";
    }

    // ✅ Fetch all credit notes
    public function index()
    {
        $response = Http::withHeaders([
            'Authorization' => "Zoho-oauthtoken {$this->zohoToken}",
        ])->get("{$this->zohoBaseUrl}?organization_id={$this->organizationId}");

        $data = $response->json();
        Log::info('Credit notes retrieved: ', $data['creditnotes'] ?? []);

        return view('creditnotes.index', ['creditnotes' => $data['creditnotes'] ?? []]);
    }

    // ✅ Show single credit note
    public function show($id)
    {
        $response = Http::withHeaders([
            'Authorization' => "Zoho-oauthtoken {$this->zohoToken}",
        ])->get("{$this->zohoBaseUrl}/{$id}?organization_id={$this->organizationId}");

        $data = $response->json();

        if (!isset($data['creditnote'])) {
            return redirect()->route('creditnotes.index')->with('error', 'Credit Note not found');
        }

        return view('creditnotes.show', ['creditnote' => $data['creditnote']]);
    }

    // ✅ Show create credit note form
    public function create()
    {
        return view('creditnotes.create');
    }

    // ✅ Store new credit note
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'customer_id' => 'required|string',
            'date' => 'required|date',
            'line_items' => 'required|array',
        ]);

        $response = Http::withHeaders([
            'Authorization' => "Zoho-oauthtoken {$this->zohoToken}",
            'Content-Type' => 'application/json',
        ])->post("{$this->zohoBaseUrl}?organization_id={$this->organizationId}", $validatedData);

        if ($response->failed()) {
            Log::error('Failed to create credit note', $response->json());
            return redirect()->back()->with('error', 'Failed to create credit note.');
        }

        return redirect()->route('creditnotes.index')->with('success', 'Credit note created successfully!');
    }

    // ✅ Show edit credit note form
    public function edit($id)
    {
        $response = Http::withHeaders([
            'Authorization' => "Zoho-oauthtoken {$this->zohoToken}",
        ])->get("{$this->zohoBaseUrl}/{$id}?organization_id={$this->organizationId}");

        $data = $response->json();

        if (!isset($data['creditnote'])) {
            Log::error("Credit note with ID {$id} not found.");
            return redirect()->route('creditnotes.index')->with('error', 'Credit note not found');
        }

        return view('creditnotes.edit', ['creditnote' => $data['creditnote']]);
    }

    // ✅ Update credit note
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'customer_id' => 'required|string',
            'date' => 'required|date',
            'line_items' => 'required|array',
        ]);

        $response = Http::withHeaders([
            'Authorization' => "Zoho-oauthtoken {$this->zohoToken}",
            'Content-Type' => 'application/json',
        ])->put("{$this->zohoBaseUrl}/{$id}?organization_id={$this->organizationId}", $validatedData);

        if ($response->failed()) {
            Log::error('Failed to update credit note', $response->json());
            return redirect()->back()->with('error', 'Failed to update credit note.');
        }

        return redirect()->route('creditnotes.index')->with('success', 'Credit note updated successfully!');
    }

    // ✅ Delete a credit note
    public function destroy($id)
    {
        $response = Http::withHeaders([
            'Authorization' => "Zoho-oauthtoken {$this->zohoToken}",
        ])->delete("{$this->zohoBaseUrl}/{$id}?organization_id={$this->organizationId}");

        if ($response->failed()) {
            Log::error('Failed to delete credit note', $response->json());
            return redirect()->route('creditnotes.index')->with('error', 'Failed to delete credit note.');
        }

        return redirect()->route('creditnotes.index')->with('success', 'Credit note deleted successfully!');
    }
}
