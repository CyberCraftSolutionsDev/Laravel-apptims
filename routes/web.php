<?php
use App\Http\Controllers\ZohoContactController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ZohoItemController;


Route::prefix('items')->group(function () {
    Route::get('/create', [ZohoItemController::class, 'create'])->name('items.create');
    Route::post('/', [ZohoItemController::class, 'store'])->name('items.store');
    Route::get('/', [ZohoItemController::class, 'index'])->name('items.index');
    Route::get('/{id}', [ZohoItemController::class, 'show'])->name('items.show');
    Route::get('/{id}/edit', [ZohoItemController::class, 'edit'])->name('items.edit');
    Route::put('/{id}', [ZohoItemController::class, 'update'])->name('items.update');
});

Route::get('/contacts', [ZohoContactController::class, 'index'])->name('contacts.list');
Route::get('/contacts/create', [ZohoContactController::class, 'create'])->name('contacts.create');
Route::post('/contacts', [ZohoContactController::class, 'store'])->name('contacts.store');
Route::get('/contacts/{id?}/edit', [ZohoContactController::class, 'edit'])->name('contacts.edit');

Route::put('/contacts/{id}', [ZohoContactController::class, 'update'])->name('contacts.update');
Route::delete('/contacts/{id}', [ZohoContactController::class, 'destroy'])->name('contacts.destroy');
Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoices.list'); // ✅ Fix: Use 'index'
Route::get('/invoices/{invoice_id}', [InvoiceController::class, 'show'])->name('invoices.details'); // ✅ Fix: Use 'show'
Route::get('/invoices/create', [InvoiceController::class, 'create'])->name('invoices.create');
// ✅ Ensure this is defined
Route::post('/invoices/store', [InvoiceController::class, 'store'])->name('invoices.store');
Route::get('/invoices/{id}/edit', [InvoiceController::class, 'edit'])->name('invoices.edit');
Route::put('/invoices/{id}', [InvoiceController::class, 'update'])->name('invoices.update');