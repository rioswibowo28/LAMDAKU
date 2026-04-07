<!DOCTYPE html>
<html>
<head>
    <title>LAMDAKU CMS - Setup Status</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f8f9fa; }
        .container { max-width: 1000px; margin: 0 auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .status { padding: 15px; margin: 10px 0; border-radius: 5px; border-left: 4px solid; }
        .success { background: #d4edda; color: #155724; border-left-color: #28a745; }
        .error { background: #f8d7da; color: #721c24; border-left-color: #dc3545; }
        .warning { background: #fff3cd; color: #856404; border-left-color: #ffc107; }
        .info { background: #d1ecf1; color: #0c5460; border-left-color: #17a2b8; }
        h1 { color: #2c3e50; text-align: center; margin-bottom: 30px; }
        h2 { color: #34495e; border-bottom: 2px solid #3498db; padding-bottom: 10px; }
        code { background: #f4f4f4; padding: 2px 6px; border-radius: 3px; font-family: 'Courier New', monospace; }
        .step { background: #e9ecef; padding: 10px; margin: 5px 0; border-radius: 5px; }
        .url-box { background: #343a40; color: #fff; padding: 15px; border-radius: 5px; margin: 10px 0; }
        .url-box a { color: #17a2b8; text-decoration: none; }
        .url-box a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🚀 LAMDAKU CMS - Setup Status</h1>
        
        <?php
        echo "<div class=\"status success\">✅ PHP Version: " . phpversion() . "</div>";
        echo "<div class=\"status success\">✅ Current Time: " . date("Y-m-d H:i:s") . "</div>";
        echo "<div class=\"status success\">✅ Server Software: " . ($_SERVER["SERVER_SOFTWARE"] ?? 'Unknown') . "</div>";
        echo "<div class=\"status success\">✅ Document Root: " . ($_SERVER["DOCUMENT_ROOT"] ?? 'Unknown') . "</div>";
        
        // Check .env
        if (file_exists("../.env")) {
            echo "<div class=\"status success\">✅ .env file exists</div>";
            
            // Check if .env has been configured
            $env = file_get_contents("../.env");
            if (strpos($env, "YOUR_DATABASE_PASSWORD_HERE") !== false) {
                echo "<div class=\"status warning\">⚠️ Database password not configured in .env</div>";
            } else {
                echo "<div class=\"status success\">✅ Database credentials configured</div>";
            }
        } else {
            echo "<div class=\"status error\">❌ .env file missing</div>";
        }
        
        // Check vendor
        if (is_dir("../vendor")) {
            echo "<div class=\"status success\">✅ Vendor directory exists</div>";
        } else {
            echo "<div class=\"status error\">❌ Vendor directory missing - Run: composer install</div>";
        }
        
        // Check storage
        if (is_dir("../storage") && is_writable("../storage")) {
            echo "<div class=\"status success\">✅ Storage directory writable</div>";
        } else {
            echo "<div class=\"status error\">❌ Storage directory not writable</div>";
        }
        
        // Check Laravel
        $laravelStatus = false;
        try {
            if (file_exists("../vendor/autoload.php")) {
                require_once "../vendor/autoload.php";
                if (file_exists("../bootstrap/app.php")) {
                    $app = require_once "../bootstrap/app.php";
                    echo "<div class=\"status success\">✅ Laravel can be loaded</div>";
                    
                    try {
                        $kernel = $app->make("Illuminate\\Contracts\\Console\\Kernel");
                        $kernel->bootstrap();
                        echo "<div class=\"status success\">✅ Laravel bootstrap successful</div>";
                        $laravelStatus = true;
                        
                        // Test database connection
                        try {
                            $pdo = $app->make("db")->connection()->getPdo();
                            echo "<div class=\"status success\">✅ Database connection successful</div>";
                            
                            // Check if migrations have been run
                            $migrationTable = $app->make("db")->getSchemaBuilder()->hasTable('migrations');
                            if ($migrationTable) {
                                $migrationCount = $app->make("db")->table('migrations')->count();
                                echo "<div class=\"status success\">✅ Database migrations: {$migrationCount} migrations found</div>";
                            } else {
                                echo "<div class=\"status warning\">⚠️ Migrations table not found - Run: php artisan migrate</div>";
                            }
                            
                        } catch (Exception $e) {
                            echo "<div class=\"status error\">❌ Database connection failed: " . $e->getMessage() . "</div>";
                        }
                        
                    } catch (Exception $e) {
                        echo "<div class=\"status error\">❌ Laravel bootstrap failed: " . $e->getMessage() . "</div>";
                    }
                }
            }
        } catch (Exception $e) {
            echo "<div class=\"status error\">❌ Laravel error: " . $e->getMessage() . "</div>";
        }
        
        // Check if APP_KEY is set
        if ($laravelStatus) {
            $appKey = config('app.key');
            if (empty($appKey)) {
                echo "<div class=\"status warning\">⚠️ APP_KEY not set - Run: php artisan key:generate</div>";
            } else {
                echo "<div class=\"status success\">✅ APP_KEY is configured</div>";
            }
        }
        
        // Check storage link
        if (is_link("../public/storage")) {
            echo "<div class=\"status success\">✅ Storage link exists</div>";
        } else {
            echo "<div class=\"status warning\">⚠️ Storage link missing - Run: php artisan storage:link</div>";
        }
        ?>
        
        <h2>📋 Setup Steps (in order):</h2>
        <div class="step">1. Upload project files to <code>/public_html/api/</code></div>
        <div class="step">2. Run: <code>php setup-lamdaku.php</code></div>
        <div class="step">3. Update database credentials in <code>.env</code> file</div>
        <div class="step">4. Run: <code>composer install --no-dev --optimize-autoloader</code></div>
        <div class="step">5. Run: <code>php artisan key:generate</code></div>
        <div class="step">6. Run: <code>php setup-database.php</code></div>
        <div class="step">7. Run: <code>php artisan storage:link</code></div>
        <div class="step">8. Run: <code>php artisan config:cache</code></div>
        <div class="step">9. Set document root to: <code>public_html/api/public</code></div>
        
        <h2>🔗 Important URLs:</h2>
        <div class="url-box">
            <strong>🌐 Frontend:</strong> <a href="https://lamdaku.com" target="_blank">https://lamdaku.com</a><br>
            <strong>🔧 Admin Panel:</strong> <a href="https://lamdaku.com/admin/login" target="_blank">https://lamdaku.com/admin/login</a><br>
            <strong>🚀 API Base:</strong> <a href="https://lamdaku.com/api/v1/" target="_blank">https://lamdaku.com/api/v1/</a><br>
            <strong>📊 Company Info API:</strong> <a href="https://lamdaku.com/api/v1/company-info" target="_blank">https://lamdaku.com/api/v1/company-info</a>
        </div>
        
        <h2>🔐 Default Admin Credentials:</h2>
        <div class="status info">
            <strong>Username:</strong> admin<br>
            <strong>Email:</strong> admin@lamdaku.com<br>
            <strong>Password:</strong> password123<br>
            <em>⚠️ Please change these credentials after first login!</em>
        </div>
        
        <h2>🗄️ Database Information:</h2>
        <div class="status info">
            <strong>Database Name:</strong> u329849080_lamdaku_prod<br>
            <strong>Username:</strong> u329849080_lamdaku_user<br>
            <strong>Host:</strong> localhost<br>
            <em>Password should be set in your Hostinger database panel</em>
        </div>
        
        <?php if ($laravelStatus): ?>
        <h2>✅ System Status: READY</h2>
        <div class="status success">
            🎉 <strong>LAMDAKU CMS is ready for use!</strong><br>
            All core components are functional. You can now access the admin panel and start configuring your website.
        </div>
        <?php else: ?>
        <h2>⚠️ System Status: SETUP REQUIRED</h2>
        <div class="status warning">
            📋 <strong>Setup is not complete.</strong><br>
            Please follow the setup steps above to complete the installation.
        </div>
        <?php endif; ?>
        
        <h2>🧹 Clean Up (after successful setup):</h2>
        <div class="step">Remove setup files: <code>rm setup-lamdaku.php setup-database.php public/setup-status.php</code></div>
    </div>
</body>
</html>
