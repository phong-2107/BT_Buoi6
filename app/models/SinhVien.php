<?php
class SinhVien extends Database {
    private $conn;

    public function __construct($dbConn) {
        $this->conn = $dbConn;
    }

    // Lấy thông tin sinh viên theo ID (để hỗ trợ update)
    public function get($id) {
        $sql = "SELECT sv.SinhVienID, sv.UserID, sv.MaSinhVien, sv.NgaySinh, sv.Lop, 
                       u.HoTen, u.Email, u.SoDienThoai 
                FROM SinhVien sv 
                JOIN Users u ON sv.UserID = u.UserID 
                WHERE sv.SinhVienID = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Lấy tất cả sinh viên
    public function getAll() {
        $sql = "SELECT sv.SinhVienID, sv.UserID, sv.MaSinhVien, sv.NgaySinh, sv.Lop, 
                       u.HoTen, u.Email 
                FROM SinhVien sv 
                JOIN Users u ON sv.UserID = u.UserID";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Tạo sinh viên mới
    public function createSinhVien($userID, $maSinhVien, $ngaySinh, $lop) {
        $sql = "INSERT INTO SinhVien (UserID, MaSinhVien, NgaySinh, Lop)
                VALUES (:userID, :maSinhVien, :ngaySinh, :lop)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':userID'     => $userID,
            ':maSinhVien' => $maSinhVien,
            ':ngaySinh'   => $ngaySinh,
            ':lop'        => $lop
        ]);
        return $this->conn->lastInsertId();
    }

    // Cập nhật thông tin sinh viên theo ID
    public function updateSinhVien($sinhVienID, $maSinhVien, $ngaySinh, $lop) {
        $sql = "UPDATE SinhVien 
                SET MaSinhVien = :maSinhVien, NgaySinh = :ngaySinh, Lop = :lop
                WHERE SinhVienID = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':maSinhVien' => $maSinhVien,
            ':ngaySinh'   => $ngaySinh,
            ':lop'        => $lop,
            ':id'         => $sinhVienID
        ]);
    }

    // Lấy thông tin sinh viên theo ID (cách viết khác)
    public function getById($id) {
        $sql = "SELECT sv.SinhVienID, sv.UserID, sv.MaSinhVien, sv.NgaySinh, sv.Lop, 
                       u.HoTen, u.Email, u.SoDienThoai 
                FROM SinhVien sv 
                JOIN Users u ON sv.UserID = u.UserID 
                WHERE sv.SinhVienID = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Xóa sinh viên theo ID
    public function deleteSinhVien($sinhVienID) {
        $sql = "DELETE FROM SinhVien WHERE SinhVienID = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $sinhVienID]);
    }
}
?>