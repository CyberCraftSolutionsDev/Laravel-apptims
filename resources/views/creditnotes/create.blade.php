@extends('layouts.app')

@section('content')
    <h2>Create Credit Note</h2>

    <form action="{{ route('creditnotes.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="customer_id">Customer ID</label>
            <input type="text" name="customer_id" id="customer_id" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" name="date" id="date" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="line_items">Line Items</label>
            <div id="line_items">
                <div class="line_item">
                    <label>Item ID</label>
                    <input type="text" name="line_items[0][item_id]" class="form-control">
                    <label>Item Name</label>
                    <input type="text" name="line_items[0][name]" class="form-control">
                    <label>Rate</label>
                    <input type="number" name="line_items[0][rate]" class="form-control">
                    <label>Quantity</label>
                    <input type="number" name="line_items[0][quantity]" class="form-control">
                    <hr>
                </div>
            </div>
            <button type="button" id="addLineItem" class="btn btn-secondary">Add Line Item</button>
        </div>

        <button type="submit" class="btn btn-primary">Create Credit Note</button>
    </form>

    <script>
        let lineItemIndex = 1;
        document.getElementById('addLineItem').addEventListener('click', function () {
            const newLineItem = `
                <div class="line_item">
                    <label>Item ID</label>
                    <input type="text" name="line_items[${lineItemIndex}][item_id]" class="form-control">
                    <label>Item Name</label>
                    <input type="text" name="line_items[${lineItemIndex}][name]" class="form-control">
                    <label>Rate</label>
                    <input type="number" name="line_items[${lineItemIndex}][rate]" class="form-control">
                    <label>Quantity</label>
                    <input type="number" name="line_items[${lineItemIndex}][quantity]" class="form-control">
                    <hr>
                </div>
            `;
            document.getElementById('line_items').insertAdjacentHTML('beforeend', newLineItem);
            lineItemIndex++;
        });
    </script>
@endsection
