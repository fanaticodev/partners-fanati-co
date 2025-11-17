<?php
/**
 * Health Check Endpoint for Hybrid MLM
 */

// Database connection check function
function checkDatabase($config) {
    try {
        $host = $config['host'] ?? 'hybrid-mlm-db';
        $port = $config['port'] ?? 3306;
        $dbname = $config['database'] ?? 'hybrid_mlm';
        $username = $config['username'] ?? 'hybrid_user';
        $password = $config['password'] ?? 'hybridpass2024';

        $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Test query
        $stmt = $pdo->query("SELECT 1");
        return $stmt !== false;
    } catch (Exception $e) {
        return false;
    }
}

// Prepare health check data
$health = [
    'status' => 'healthy',
    'timestamp' => date('c'),
    'environment' => $_SERVER['APP_ENV'] ?? 'production',
    'service' => 'hybrid-mlm',
    'type' => 'legacy',
    'checks' => []
];

// Check PHP version
$health['checks']['php'] = [
    'status' => version_compare(PHP_VERSION, '7.4.0', '>=') ? 'healthy' : 'unhealthy',
    'version' => PHP_VERSION
];

// Check required PHP extensions
$requiredExtensions = ['pdo', 'pdo_mysql', 'json', 'mbstring', 'openssl'];
$health['checks']['extensions'] = [
    'status' => 'healthy',
    'loaded' => [],
    'missing' => []
];

foreach ($requiredExtensions as $ext) {
    if (extension_loaded($ext)) {
        $health['checks']['extensions']['loaded'][] = $ext;
    } else {
        $health['checks']['extensions']['missing'][] = $ext;
        $health['checks']['extensions']['status'] = 'unhealthy';
    }
}

// Check database connection
$dbConfig = [
    'host' => $_SERVER['DB_HOST'] ?? 'hybrid-mlm-db',
    'port' => $_SERVER['DB_PORT'] ?? 3306,
    'database' => $_SERVER['DB_DATABASE'] ?? 'hybrid_mlm',
    'username' => $_SERVER['DB_USERNAME'] ?? 'hybrid_user',
    'password' => $_SERVER['DB_PASSWORD'] ?? 'hybridpass2024'
];

$health['checks']['database'] = [
    'status' => checkDatabase($dbConfig) ? 'healthy' : 'unhealthy',
    'host' => $dbConfig['host'],
    'database' => $dbConfig['database']
];

// Check FCO Token Module
$fcoModulePath = dirname(__DIR__) . '/app/Components/Modules/General/FcoTokens';
$health['checks']['fco_module'] = [
    'status' => is_dir($fcoModulePath) ? 'healthy' : 'missing',
    'path' => $fcoModulePath,
    'exists' => is_dir($fcoModulePath)
];

// Check vendor directory
$vendorPath = dirname(__DIR__) . '/vendor';
$health['checks']['dependencies'] = [
    'status' => is_dir($vendorPath) ? 'healthy' : 'missing',
    'path' => $vendorPath,
    'exists' => is_dir($vendorPath)
];

// Check storage directory
$storagePath = dirname(__DIR__) . '/storage';
$health['checks']['storage'] = [
    'status' => is_writable($storagePath) ? 'healthy' : 'unhealthy',
    'path' => $storagePath,
    'writable' => is_writable($storagePath)
];

// Check disk space
$diskFree = disk_free_space('/');
$diskTotal = disk_total_space('/');
$diskUsedPercent = 100 - round(($diskFree / $diskTotal) * 100);

$health['checks']['disk'] = [
    'status' => $diskUsedPercent < 90 ? 'healthy' : 'unhealthy',
    'used_percent' => $diskUsedPercent,
    'free_gb' => round($diskFree / 1024 / 1024 / 1024, 2)
];

// Overall health status
$overallHealthy = true;
foreach ($health['checks'] as $check) {
    if (isset($check['status']) && ($check['status'] === 'unhealthy' || $check['status'] === 'missing')) {
        $overallHealthy = false;
        break;
    }
}

$health['status'] = $overallHealthy ? 'healthy' : 'unhealthy';

// Set response headers
header('Content-Type: application/json');
header('Cache-Control: no-cache, no-store, must-revalidate');
header('X-Service: hybrid-mlm');
header('X-Type: legacy');

// Return appropriate HTTP status code
if (!$overallHealthy) {
    http_response_code(503); // Service Unavailable
} else {
    http_response_code(200); // OK
}

// Output JSON response
echo json_encode($health, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);