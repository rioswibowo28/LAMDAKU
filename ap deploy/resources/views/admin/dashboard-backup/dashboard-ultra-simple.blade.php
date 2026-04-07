<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Test</title>
</head>
<body>
    <h1>🎉 DASHBOARD BERHASIL!</h1>
    <p>Jika Anda melihat halaman ini, berarti Laravel dashboard sudah berfungsi!</p>
    
    <h2>Data dari Controller:</h2>
    <ul>
        <li>Services: {{ $stats['services'] ?? 'N/A' }}</li>
        <li>Timelines: {{ $stats['timelines'] ?? 'N/A' }}</li>
        <li>Contacts: {{ $stats['contacts'] ?? 'N/A' }}</li>
        <li>Pages: {{ $stats['pages'] ?? 'N/A' }}</li>
    </ul>
    
    <h2>Session Info:</h2>
    <ul>
        <li>Admin Authenticated: {{ session('admin_authenticated') ? 'YES' : 'NO' }}</li>
        <li>Admin User: {{ session('admin_user', 'N/A') }}</li>
    </ul>
    
    <h2>Server Info:</h2>
    <ul>
        <li>Laravel: {{ app()->version() }}</li>
        <li>PHP: {{ PHP_VERSION }}</li>
        <li>Time: {{ now() }}</li>
    </ul>
    
    <p><a href="{{ route('admin.logout') }}">Logout</a></p>
</body>
</html>
