<?php
class Database {
    private static $instance = null;   // Lưu thể hiện (instance) duy nhất
    private $conn;

    // Thông tin kết nối
    private $host = "localhost";  
    private $user = "root";      
    private $pass = "";          
    private $dbname = "thesismanagementdb";

    // Hàm khởi tạo ở chế độ private để ngăn tạo nhiều instance
    private function __construct() {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset=utf8";
            $this->conn = new PDO($dsn, $this->user, $this->pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        } catch (PDOException $e) {
            die("Kết nối thất bại: " . $e->getMessage());
        }
    }

    // Hàm tĩnh để lấy instance duy nhất
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    // Hàm public để lấy đối tượng PDO
    public function getConnection() {
        return $this->conn;
    }
}