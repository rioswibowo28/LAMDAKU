<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Test - LAMDAKU</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .test-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 30px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .status-ok {
            color: #28a745;
            font-weight: bold;
        }
        .status-error {
            color: #dc3545;
            font-weight: bold;
        }
        .debug-section {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin: 15px 0;
            border-left: 4px solid #007bff;
        }
    </style>
</head>
<body>
    <div class="test-container">
        <div class="text-center mb-4">
            <h1 class="status-ok">✅ Dashboard Test Berhasil!</h1>
            <p class="lead">Jika Anda melihat halaman ini, berarti Laravel dapat merender view dengan baik.</p>
        </div>

        <div class="debug-section">
            <h4>📊 Informasi Debug Session:</h4>
            <ul class="list-unstyled">
                <li><strong>Session Admin:</strong> 
                    <span class="{{ session('admin_authenticated') ? 'status-ok' : 'status-error' }}">
                        {{ session('admin_authenticated') ? 'Authenticated ✅' : 'Not Authenticated ❌' }}
                    </span>
                </li>
                <li><strong>Admin User:</strong> {{ session('admin_user', 'Tidak ada data') }}</li>
                <li><strong>Current URL:</strong> {{ request()->fullUrl() }}</li>
                <li><strong>Route Name:</strong> {{ request()->route()->getName() ?? 'Tidak ada' }}</li>
                <li><strong>HTTP Method:</strong> {{ request()->method() }}</li>
            </ul>
        </div>

        <div class="debug-section">
            <h4>🔧 Test Data Models:</h4>
            <ul class="list-unstyled">
                <li><strong>Service Model:</strong> 
                    @try
                        <span class="status-ok">{{ \App\Models\Service::count() }} records ✅</span>
                    @catch(\Exception $e)
                        <span class="status-error">Error: {{ $e->getMessage() }} ❌</span>
                    @endtry
                </li>
                <li><strong>Contact Model:</strong> 
                    @try
                        <span class="status-ok">{{ \App\Models\Contact::count() }} records ✅</span>
                    @catch(\Exception $e)
                        <span class="status-error">Error: {{ $e->getMessage() }} ❌</span>
                    @endtry
                </li>
                <li><strong>Timeline Model:</strong> 
                    @try
                        <span class="status-ok">{{ \App\Models\Timeline::count() }} records ✅</span>
                    @catch(\Exception $e)
                        <span class="status-error">Error: {{ $e->getMessage() }} ❌</span>
                    @endtry
                </li>
                <li><strong>Page Model:</strong> 
                    @try
                        <span class="status-ok">{{ \App\Models\Page::count() }} records ✅</span>
                    @catch(\Exception $e)
                        <span class="status-error">Error: {{ $e->getMessage() }} ❌</span>
                    @endtry
                </li>
            </ul>
        </div>

        <div class="debug-section">
            <h4>🌐 Environment Info:</h4>
            <ul class="list-unstyled">
                <li><strong>Laravel Version:</strong> {{ app()->version() }}</li>
                <li><strong>PHP Version:</strong> {{ PHP_VERSION }}</li>
                <li><strong>Environment:</strong> {{ app()->environment() }}</li>
                <li><strong>Debug Mode:</strong> {{ config('app.debug') ? 'Enabled' : 'Disabled' }}</li>
            </ul>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">🏠 Coba Dashboard Normal</a>
            <a href="{{ url('/admin/login') }}" class="btn btn-secondary">🔐 Kembali ke Login</a>
        </div>

        <div class="mt-4 p-3 bg-info text-white rounded">
            <strong>💡 Catatan:</strong> Halaman ini dibuat untuk debugging. Jika dashboard normal masih blank, 
            periksa browser console (F12) untuk error JavaScript atau masalah lainnya.
        </div>
    </div>

    <script>
        console.log('🔧 Dashboard Test Page Loaded');
        console.log('Current URL:', window.location.href);
        console.log('Session data from server:', {
            authenticated: {{ session('admin_authenticated') ? 'true' : 'false' }},
            user: '{{ session('admin_user', 'N/A') }}'
        });

        // Test Bootstrap loading
        if (typeof bootstrap !== 'undefined') {
            console.log('✅ Bootstrap loaded successfully');
        } else {
            console.log('❌ Bootstrap not loaded');
        }

        // Test if document is ready
        document.addEventListener('DOMContentLoaded', function() {
            console.log('✅ DOM loaded successfully');
            
            // Add visual confirmation
            const container = document.querySelector('.test-container');
            if (container) {
                container.style.border = '3px solid #28a745';
                console.log('✅ JavaScript execution working');
            }
        });
    </script>
</body>
</html>
