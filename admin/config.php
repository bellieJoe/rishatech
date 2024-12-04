<?php
class Database {
    private $host = 'localhost';        // Database host
    private $db_name = 'rishatech_db';   // Database name
    private $username = 'root';       // Database username
    private $password = '';       // Database password
    public $pdo;

    public function __construct() {
        try {
            $this->pdo = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            echo "Database connection error: " . $exception->getMessage();
        }
    }
}

// Instantiate the database to use in other parts of the application
$db = new Database();
?>

