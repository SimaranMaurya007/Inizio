<?php
// Add Dotenv loading
require_once __DIR__ . '/../vendor/autoload.php';
use Dotenv\Dotenv;

class Connection {
    
    private static $connect = NULL;
    
    public static function getInstance() {
        if (Connection::$connect === NULL) {
            try {
                // Load environment variables from .env if not already loaded
                if (!getenv('DB_HOST')) {
                    $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
                    $dotenv->load();
                }
                
                // Get database configuration from environment variables
                $host = $_ENV['DB_HOST'] ?? getenv('DB_HOST');
                $database = $_ENV['DB_DATABASE'] ?? getenv('DB_DATABASE');
                $username = $_ENV['DB_USERNAME'] ?? getenv('DB_USERNAME');
                $password = $_ENV['DB_PASSWORD'] ?? getenv('DB_PASSWORD');
                
                // Validate that all required environment variables are set
                if (!$host || !$database || !$username) {
                    throw new Exception("Database configuration missing. Please check your environment variables: DB_HOST, DB_DATABASE, DB_USERNAME, DB_PASSWORD");
                }

                $dsn = "mysql:host=" . $host . ";dbname=" . $database . ";charset=utf8mb4";
                Connection::$connect = new PDO($dsn, $username, $password, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false
                ]);
                
                if (!Connection::$connect) {
                    throw new Exception("Could not connect to database");
                }
            } catch (Exception $e) {
                error_log("Database connection error: " . $e->getMessage());
                throw new Exception("Database connection failed. Please check your configuration.");
            }
        }
        
        return Connection::$connect;
    }
    
    public static function getMySQLDate($date) {
        $date_arr  = explode('-', $date);
        return $date_arr[2] . '-' . $date_arr[1] . '-' . $date_arr[0];
    }
}
