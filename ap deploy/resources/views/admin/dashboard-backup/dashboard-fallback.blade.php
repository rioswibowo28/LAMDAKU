<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAMDAKU Admin Dashboard - Fallback</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #f8fafc;
            padding: 30px;
            margin: 0;
            color: #1e293b;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        .card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }
        h1 {
            color: #667eea;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .stat-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-left: 4px solid #667eea;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        .btn {
            padding: 10px 15px;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>LAMDAKU Admin Dashboard</h1>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn">Keluar</button>
            </form>
        </div>
        
        <div class="card">
            <h2>Selamat Datang, {{ session('admin_user', 'Administrator') }}!</h2>
            <p>Ini adalah halaman dashboard fallback yang muncul jika ada masalah dengan dashboard utama.</p>
        </div>
        
        <h2>Statistik</h2>
        <div class="stats-grid">
            <div class="stat-card">
                <h3>Halaman</h3>
                <p>{{ $stats['pages'] ?? '0' }}</p>
            </div>
            
            <div class="stat-card">
                <h3>Layanan</h3>
                <p>{{ $stats['services'] ?? '0' }}</p>
            </div>
            
            <div class="stat-card">
                <h3>Timeline</h3>
                <p>{{ $stats['timelines'] ?? '0' }}</p>
            </div>
            
            <div class="stat-card">
                <h3>Kontak</h3>
                <p>{{ $stats['contacts'] ?? '0' }}</p>
            </div>
        </div>
        
        <script>
            console.log('Fallback dashboard loaded');
        </script>
    </div>
</body>
</html>
