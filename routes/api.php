<?php
use App\Http\Controllers\ZohoContactController;
use App\Http\Controllers\InvoiceController;

Route::prefix('contacts' )->group(function () {
    Route::get('/', [ZohoContactController::class, 'index']); // Get all contacts
    Route::post('/', [ZohoContactController::class, 'store']); // Create a contact
    Route::get('/{id}', [ZohoContactController::class, 'show']); // Get a single contact
    Route::put('/{id}', [ZohoContactController::class, 'update']); // Update a contact
    Route::delete('/{id}', [ZohoContactController::class, 'destroy']); // Delete a contact

    
});
Route::prefix('invoices')->group(function () {
    Route::get('/', [InvoiceController::class, 'index']); // Get all invoices
    Route::post('/', [InvoiceController::class, 'store']); // Create an invoice
    Route::get('/create', [InvoiceController::class, 'create']); // Show create invoice page
    Route::get('/{id}', [InvoiceController::class, 'show']); // Get a single invoice
    Route::put('/{id}', [InvoiceController::class, 'update']); // Update an invoice
    Route::delete('/{id}', [InvoiceController::class, 'destroy']); // Delete an invoice
});
