<?php
// Add Dotenv loading
require_once __DIR__ . '/../vendor/autoload.php';
use Dotenv\Dotenv;

class Connection {
    
    private static $connect = NULL;
    
    public static function getInstance() {
        // Check if .env file exists
        if (!file_exists(__DIR__ . '/../.env')) {
            die('.env file not found');
        }
        if (Connection::$connect === NULL) {
            // Load environment variables from .env if not already loaded
            if (!getenv('DB_HOST')) {
                $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
                $dotenv->load();
            }
            $host = $_ENV['DB_HOST'];
            $database = $_ENV['DB_DATABASE'];
            $username = $_ENV['DB_USERNAME'];
            $password = $_ENV['DB_PASSWORD'];

            $dsn = "mysql:host=" . $host . ";dbname=" . $database;
            Connection::$connect = new PDO($dsn, $username, $password);
            if (!Connection::$connect) {
                die("Could not connect to database");
            }
        }
        
        return Connection::$connect;
    }
    
    public static function getMySQLDate($date) {
        $date_arr  = explode('-', $date);
        return $date_arr[2] . '-' . $date_arr[1] . '-' . $date_arr[0];
    }
}
