<?php
class User extends Database {
    private $conn;

    public function __construct($dbConn) {
        $this->conn = $dbConn;
    }

    // Lấy thông tin user theo UserID
    public function get($userId) {
        $stmt = $this->conn->prepare("SELECT * FROM Users WHERE UserID = :id");
        $stmt->execute([':id' => $userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Đăng nhập bằng username và password
    public function getUserByCredentials($username, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM Users WHERE Username = :username");
        $stmt->execute([':username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['PasswordHash'])) {
            return $user; // Đăng nhập thành công
        }
        return false; // Sai username hoặc password
    }

    // Kiểm tra username tồn tại chưa
    public function checkUserExists($username) {
        $sql = "SELECT COUNT(*) AS cnt FROM Users WHERE Username = :username";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':username' => $username]);
        $row = $stmt->fetch();
        return ($row['cnt'] > 0);
    }

    // Tạo user mới
    public function createUser($username, $hashedPassword, $hoTen, $email, $sdt, $userType) {
        $sql = "INSERT INTO Users (Username, PasswordHash, HoTen, Email, SoDienThoai, UserType)
                VALUES (:username, :password, :hoten, :email, :sdt, :userType)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':username' => $username,
            ':password' => $hashedPassword,
            ':hoten'    => $hoTen,
            ':email'    => $email,
            ':sdt'      => $sdt,
            ':userType' => $userType
        ]);
        return $this->conn->lastInsertId();
    }
    
    // Cập nhật thông tin user (dành cho Sinh viên khi cập nhật thông tin cá nhân)
    public function updateUser($userId, $hoTen, $email, $sdt) {
        $sql = "UPDATE Users 
                SET HoTen = :hoten, Email = :email, SoDienThoai = :sdt 
                WHERE UserID = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':hoten' => $hoTen,
            ':email' => $email,
            ':sdt'   => $sdt,
            ':id'    => $userId
        ]);
    }
}