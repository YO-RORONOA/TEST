<?php
require __DIR__ . '/../../vendor/autoload.php';
use Dotenv\Dotenv;



class Database
{
// Load environment variables
protected $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');

protected $servername = $_ENV['DB_HOST'];
protected $username = $_ENV['DB_USER'];
protected $password = $_ENV['DB_PASSWORD'];
protected $dbname = $_ENV['DB_NAME'];
protected $pdo;
protected $dsn;

public function conn()
{


$this->dotenv->load();

// Database configuration

try {
    // Create a PDO connection
    $this->dsn = "mysql:host=$this->servername;dbname=$this->dbname;charset=utf8mb4";
    $this->pdo = new PDO($this->dsn, $this->username, $this->password);

    // Set PDO error mode to exception
    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Confirm connection
    // echo "Connected successfully";
} catch (PDOException $e) {
    // Handle connection error
    die("Connection failed: " . $e->getMessage());
}

return $this->pdo;






}
}
?>