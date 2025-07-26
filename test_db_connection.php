<?php
// Test database connection for Render deployment
require_once 'vendor/autoload.php';
use Dotenv\Dotenv;

echo "<h2>Database Connection Test</h2>";

try {
    // Test environment variables
    echo "<h3>Environment Variables:</h3>";
    
    // Try to load .env file
    if (file_exists(__DIR__ . '/.env')) {
        $dotenv = Dotenv::createImmutable(__DIR__);
        $dotenv->load();
        echo "✓ .env file loaded<br>";
    } else {
        echo "⚠ .env file not found, using system environment variables<br>";
    }
    
    // Check environment variables
    $host = $_ENV['DB_HOST'] ?? getenv('DB_HOST');
    $database = $_ENV['DB_DATABASE'] ?? getenv('DB_DATABASE');
    $username = $_ENV['DB_USERNAME'] ?? getenv('DB_USERNAME');
    $password = $_ENV['DB_PASSWORD'] ?? getenv('DB_PASSWORD');
    
    echo "DB_HOST: " . ($host ? $host : "❌ NOT SET") . "<br>";
    echo "DB_DATABASE: " . ($database ? $database : "❌ NOT SET") . "<br>";
    echo "DB_USERNAME: " . ($username ? $username : "❌ NOT SET") . "<br>";
    echo "DB_PASSWORD: " . ($password ? "✓ SET" : "❌ NOT SET") . "<br>";
    
    if (!$host || !$database || !$username) {
        throw new Exception("Missing required environment variables");
    }
    
    echo "<h3>Testing Database Connection:</h3>";
    
    // Test direct PDO connection
    $dsn = "mysql:host=" . $host . ";dbname=" . $database . ";charset=utf8mb4";
    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    
    echo "✓ Direct PDO connection successful<br>";
    
    // Test Connection class
    require_once 'classes/Connection.php';
    $connection = Connection::getInstance();
    echo "✓ Connection class working<br>";
    
    // Test a simple query
    $stmt = $connection->query("SELECT 1 as test");
    $result = $stmt->fetch();
    echo "✓ Database query successful<br>";
    
    echo "<h3>✅ All tests passed! Database connection is working.</h3>";
    
} catch (Exception $e) {
    echo "<h3>❌ Error:</h3>";
    echo "<p>" . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<h3>Debug Information:</h3>";
    echo "<p>PHP Version: " . PHP_VERSION . "</p>";
    echo "<p>PDO MySQL available: " . (extension_loaded('pdo_mysql') ? 'Yes' : 'No') . "</p>";
    echo "<p>Current directory: " . __DIR__ . "</p>";
}
?> 