<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'CRAFTCYBERzoho')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f8f9fa;">

    <!-- Sidebar -->
    <div style="width: 200px; height: 100vh; position: fixed; background: #343a40; color: white; padding-top: 20px;">
        <div style="text-align: center; padding-bottom: 10px;">
            <a href="{{ url('/contacts') }}" style="color: white; text-decoration: none; font-size: 24px; font-weight: bold;">
                <span style="font-size: 28px; margin-right: 5px;">🏠</span>Craft
            </a>
        </div>
        <ul style="list-style: none; padding: 0;">
            <li style="padding: 10px;"><a href="{{ route('contacts.list') }}" style="color: white; text-decoration: none;">📇 Contacts</a></li>
            <li style="padding: 10px;"><a href="{{ route('invoices.list') }}" style="color: white; text-decoration: none;">🧾 Invoices</a></li>
            <li style="padding: 10px;"><a href="{{ route('items.index') }}" style="color: white; text-decoration: none;">📦 Items</a></li>
            <li style="padding: 10px;"><a href="{{ route('creditnotes.index') }}" style="color: white; text-decoration: none;">💼 Credit Notes</a></li>
        </ul>
    </div>

    <!-- Main Content with Navigation Bar -->
    <div style="margin-left: 200px;">

        <!-- Top Navigation Bar -->
        <nav style="background-color:#343a40; padding: 10px; display: flex; justify-content: space-between; align-items: center;">
            <div style="display: flex; align-items: center;">
                <a href="{{ url('/contacts') }}" style="color: white; text-decoration: none; font-size: 24px; font-weight: bold;">
                    
                </a>
            </div>
            <div style="display: flex; gap: 15px;">
                <a href="{{ route('contacts.create') }}" style="color: white; text-decoration: none; padding: 5px 10px;">Create</a>
                <a href="{{ route('contacts.create') }}" style="color: white; text-decoration: none; padding: 5px 10px;">Home</a>
                <a href="{{ route('contacts.edit') }}" style="color: white; text-decoration: none; padding: 5px 10px;">Edit</a>
            </div>
        </nav>

        <!-- Main Content -->
        <div style="max-width: 1200px; margin: 20px auto; padding: 20px; background: white; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
            @yield('content')
        </div>

        <!-- Footer -->
        <footer style="background-color: #007bff; color: white; text-align: center; padding: 15px; margin-top: 20px;">
            <p>&copy; 2024 Cyber Craft Solutions. All rights reserved.</p>
        </footer>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
