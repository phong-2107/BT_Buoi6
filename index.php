<?php
session_start();

// Nạp file Database (PDO)
require_once __DIR__ . '/app/config/database.php';
// Nạp các Controller
require_once __DIR__ . '/app/controllers/SinhVienController.php';
require_once __DIR__ . '/app/controllers/GiangVienController.php';

// Khởi tạo kết nối DB
$db = new Database();
$conn = $db->getConnection();

// Tạo đối tượng Controller
$sinhVienController = new SinhVienController($conn);
$giangVienController = new GiangVienController($conn);

// Lấy action từ URL (ví dụ: ?action=sinhvien_create)
$action = isset($_GET['action']) ? $_GET['action'] : 'home';

// Điều hướng đến Controller/Method tùy vào action
switch ($action) {
    // =================== SINH VIÊN ===================
    case 'sinhvien_index':
        $sinhVienController->index();
        break;

    case 'sinhvien_create':
        // Hiển thị form tạo sinh viên
        $sinhVienController->create();
        break;

    case 'sinhvien_store':
        // Xử lý form POST tạo sinh viên
        $sinhVienController->store();
        break;

    case 'sinhvien_delete':
        // Xóa sinh viên theo ID
        if (isset($_GET['id'])) {
            $sinhVienController->delete($_GET['id']);
        } else {
            echo "Thiếu tham số id!";
        }
        break;

    // =================== GIẢNG VIÊN ===================
    case 'giangvien_index':
        $giangVienController->index();
        break;

    case 'giangvien_create':
        // Hiển thị form tạo giảng viên
        $giangVienController->create();
        break;

    case 'giangvien_store':
        // Xử lý form POST tạo giảng viên
        $giangVienController->store();
        break;

    case 'giangvien_delete':
        // Xóa giảng viên theo ID
        if (isset($_GET['id'])) {
            $giangVienController->delete($_GET['id']);
        } else {
            echo "Thiếu tham số id!";
        }
        break;

    // =================== TRANG CHỦ HOẶC MẶC ĐỊNH ===================
    case 'home':
    default:
        // Trang chủ đơn giản
        echo "<h1>Trang chủ</h1>";
        echo "<p>Chọn chức năng bên trên...</p>";
        // Bạn có thể thay bằng include file view:
        // include __DIR__ . '/app/views/home.php';
        break;
}