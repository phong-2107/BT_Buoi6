<?php
class SinhVien extends Database {
    private $conn;

    public function __construct($dbConn) {
        $this->conn = $dbConn;
    }

    // Lấy tất cả sinh viên
    public function getAll() {
        $stmt = $this->conn->prepare("SELECT sv.*, u.HoTen, u.Email 
                                      FROM SinhVien sv 
                                      JOIN Users u ON sv.UserID = u.UserID");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Tạo sinh viên mới
    public function createSinhVien($userID, $maSinhVien, $ngaySinh, $lop) {
        $sql = "INSERT INTO SinhVien (UserID, MaSinhVien, NgaySinh, Lop)
                VALUES (:userID, :maSinhVien, :ngaySinh, :lop)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':userID'      => $userID,
            ':maSinhVien'  => $maSinhVien,
            ':ngaySinh'    => $ngaySinh,
            ':lop'         => $lop
        ]);
        return $this->conn->lastInsertId();
    }

    // Xóa sinh viên theo ID
    public function deleteSinhVien($sinhVienID) {
        $sql = "DELETE FROM SinhVien WHERE SinhVienID = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $sinhVienID]);
    }
}