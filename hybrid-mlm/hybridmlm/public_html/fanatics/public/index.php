<?php
/**
 * Hybrid MLM - Legacy System Entry Point
 */

// Check if the application bootstrap exists
$appBootstrap = dirname(__DIR__) . '/app/bootstrap.php';
$vendorAutoload = dirname(__DIR__) . '/vendor/autoload.php';

// Try to load the application
if (file_exists($appBootstrap)) {
    require_once $appBootstrap;
} elseif (file_exists($vendorAutoload)) {
    require_once $vendorAutoload;
}

// If no bootstrap found, show placeholder
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hybrid MLM - Legacy System</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            padding: 50px;
            max-width: 600px;
            width: 100%;
            text-align: center;
        }

        .logo {
            width: 80px;
            height: 80px;
            margin: 0 auto 30px;
            background: #6b7280;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 36px;
            font-weight: bold;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
            font-size: 32px;
        }

        .status {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 30px;
            background: #6b7280;
            color: white;
        }

        p {
            color: #666;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin: 40px 0;
        }

        .info-card {
            padding: 20px;
            background: #f9fafb;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
        }

        .info-card h3 {
            color: #6b7280;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 10px;
        }

        .info-card p {
            color: #333;
            font-size: 16px;
            margin: 0;
            word-break: break-all;
        }

        .feature-list {
            text-align: left;
            max-width: 400px;
            margin: 20px auto;
            color: #666;
        }

        .feature-list li {
            margin: 10px 0;
            padding-left: 25px;
            position: relative;
        }

        .feature-list li::before {
            content: "✓";
            position: absolute;
            left: 0;
            color: #10b981;
            font-weight: bold;
        }

        .links {
            margin-top: 30px;
            padding-top: 30px;
            border-top: 1px solid #e5e7eb;
        }

        .links a {
            display: inline-block;
            margin: 0 10px;
            padding: 12px 24px;
            background: #6b7280;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .links a:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(107, 114, 128, 0.4);
        }

        .links a.primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .links a.primary:hover {
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.4);
        }

        @media (max-width: 600px) {
            .container {
                padding: 30px;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            h1 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">H</div>

        <h1>Hybrid MLM System</h1>

        <div class="status">Legacy Platform</div>

        <p>
            Welcome to the Hybrid MLM legacy system for Partners Fanati.co.
            This system maintains backward compatibility with existing member data
            and provides essential MLM operations.
        </p>

        <div class="info-grid">
            <div class="info-card">
                <h3>System Type</h3>
                <p>Legacy MLM</p>
            </div>
            <div class="info-card">
                <h3>PHP Version</h3>
                <p><?php echo PHP_VERSION; ?></p>
            </div>
            <div class="info-card">
                <h3>Environment</h3>
                <p><?php echo $_SERVER['APP_ENV'] ?? 'Production'; ?></p>
            </div>
            <div class="info-card">
                <h3>Status</h3>
                <p>Operational</p>
            </div>
        </div>

        <p style="background: #eff6ff; padding: 15px; border-radius: 8px; color: #1e40af;">
            <strong>ℹ️ Features:</strong> This legacy system currently provides:
        </p>

        <ul class="feature-list">
            <li>FCO Token Module</li>
            <li>Member Database Management</li>
            <li>Commission Tracking</li>
            <li>Historical Transaction Data</li>
            <li>Backward Compatibility</li>
            <li>Data Migration Support</li>
        </ul>

        <div class="links">
            <a href="/" class="primary">New Infinite MLM</a>
            <a href="/health">Health Check</a>
        </div>

        <p style="margin-top: 30px; font-size: 14px; color: #9ca3af;">
            <?php
            // Show directory information for debugging
            echo "Document Root: " . $_SERVER['DOCUMENT_ROOT'] . "<br>";
            echo "Script Path: " . __FILE__;
            ?>
        </p>
    </div>
</body>
</html>