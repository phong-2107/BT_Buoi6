<?php
class SinhVienGiangVienHuongDan extends Database {
    private $conn;

    public function __construct($dbConn) {
        $this->conn = $dbConn;
    }

    // Thêm mới bản ghi hướng dẫn
    public function create($sinhVienID, $giangVienID, $ngayBatDau, $ghiChu = null) {
        $sql = "INSERT INTO SinhVienGiangVienHuongDan (SinhVienID, GiangVienID, NgayBatDau, GhiChu)
                VALUES (:sinhVienID, :giangVienID, :ngayBatDau, :ghiChu)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':sinhVienID'  => $sinhVienID,
            ':giangVienID' => $giangVienID,
            ':ngayBatDau'  => $ngayBatDau,
            ':ghiChu'      => $ghiChu
        ]);
        return $this->conn->lastInsertId();
    }

    // Lấy tất cả danh sách phân công hướng dẫn
    public function getAll() {
        $sql = "SELECT 
                    h.*, 
                    sv.MaSinhVien, 
                    u.HoTen AS TenSinhVien, 
                    gv.MaGiangVien, 
                    u2.HoTen AS TenGiangVien
                FROM SinhVienGiangVienHuongDan h
                JOIN SinhVien sv ON h.SinhVienID = sv.SinhVienID
                JOIN Users u ON sv.UserID = u.UserID
                JOIN GiangVien gv ON h.GiangVienID = gv.GiangVienID
                JOIN Users u2 ON gv.UserID = u2.UserID
                ORDER BY h.NgayBatDau DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy thông tin bản ghi hướng dẫn theo ID
    public function getById($id) {
        $sql = "SELECT 
                    h.*, 
                    sv.MaSinhVien, 
                    u.HoTen AS TenSinhVien, 
                    gv.MaGiangVien, 
                    u2.HoTen AS TenGiangVien
                FROM SinhVienGiangVienHuongDan h
                JOIN SinhVien sv ON h.SinhVienID = sv.SinhVienID
                JOIN Users u ON sv.UserID = u.UserID
                JOIN GiangVien gv ON h.GiangVienID = gv.GiangVienID
                JOIN Users u2 ON gv.UserID = u2.UserID
                WHERE h.SinhVienGiangVienHuongDanID = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Cập nhật bản ghi hướng dẫn theo ID
    public function update($id, $sinhVienID, $giangVienID, $ngayBatDau, $ghiChu = null) {
        $sql = "UPDATE SinhVienGiangVienHuongDan
                SET SinhVienID = :sinhVienID, 
                    GiangVienID = :giangVienID, 
                    NgayBatDau = :ngayBatDau, 
                    GhiChu = :ghiChu
                WHERE SinhVienGiangVienHuongDanID = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':sinhVienID'  => $sinhVienID,
            ':giangVienID' => $giangVienID,
            ':ngayBatDau'  => $ngayBatDau,
            ':ghiChu'      => $ghiChu,
            ':id'          => $id
        ]);
    }

    // Xóa bản ghi hướng dẫn theo ID
    public function delete($id) {
        $sql = "DELETE FROM SinhVienGiangVienHuongDan WHERE SinhVienGiangVienHuongDanID = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
?>