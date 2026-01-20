<!DOCTYPE html>
<html>
<head>
    <title>Employee Panel</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        .header { background: #f4f4f4; padding: 10px; margin-bottom: 20px; }
        .content { background: #fff; padding: 20px; border: 1px solid #ccc; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Employee Dashboard</h2>
<form id="logout-form" action="{{ route('employee.logout') }}" method="POST" style="display: inline;">
    @csrf
    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        Logout
    </a>
</form>
    </div>

    <div class="content">
        @yield('content')
    </div>
</body>
</html>
