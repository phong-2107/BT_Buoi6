<?php
class GiangVien extends Database {
    private $conn;

    public function __construct($dbConn) {
        $this->conn = $dbConn;
    }

    // Lấy tất cả giảng viên
    public function getAll() {
        $stmt = $this->conn->prepare("SELECT gv.*, u.HoTen, u.Email 
                                      FROM GiangVien gv 
                                      JOIN Users u ON gv.UserID = u.UserID");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Tạo giảng viên mới
    public function createGiangVien($userID, $maGiangVien, $boMon) {
        $sql = "INSERT INTO GiangVien (UserID, MaGiangVien, BoMon)
                VALUES (:userID, :maGiangVien, :boMon)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':userID'      => $userID,
            ':maGiangVien' => $maGiangVien,
            ':boMon'       => $boMon
        ]);
        return $this->conn->lastInsertId();
    }

    // Xóa giảng viên theo ID
    public function deleteGiangVien($giangVienID) {
        $sql = "DELETE FROM GiangVien WHERE GiangVienID = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $giangVienID]);
    }
}