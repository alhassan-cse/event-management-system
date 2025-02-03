<?php
class Connect {
    private $host = "localhost"; // Database host
    private $dbname = "event_management_db"; // Database name
    private $username = "root"; // Database username
    private $password = ""; // Database password
    public $pdo;
  
    public function __construct() {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset=utf8mb4";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]; 
            $this->pdo = new PDO($dsn, $this->username, $this->password, $options);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }
    // Method to get the PDO connection
    public function getConnection() {
        return $this->pdo;
    }
}
 
?>