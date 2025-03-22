<?php
session_start();

// Nạp file Database (PDO) sử dụng Singleton
require_once __DIR__ . '/../app/config/database.php';
// Nạp các Controller
require_once __DIR__ . '/../app/controllers/SinhVienController.php';
require_once __DIR__ . '/../app/controllers/GiangVienController.php';
require_once __DIR__ . '/../app/controllers/UserController.php';
require_once __DIR__ . '/../app/controllers/HuongDanController.php';

// Lấy đối tượng PDO thông qua Singleton Database
$db = Database::getInstance();
$conn = $db->getConnection();

// Tạo các đối tượng Controller với dependency injection (PDO)
$sinhVienController   = new SinhVienController($conn);
$giangVienController  = new GiangVienController($conn);
$userController       = new UserController($conn);
$huongDanController   = new HuongDanController($conn);

// Lấy action từ URL (ví dụ: ?action=sinhvien_create, ?action=login, ?action=assign, ...)
$action = isset($_GET['action']) ? $_GET['action'] : 'home';

// Điều hướng đến Controller/Method tương ứng với action
switch ($action) {
    // =================== SINH VIÊN ===================
    case 'sinhvien_index':
        $sinhVienController->index();
        break;
    case 'sinhvien_create': 
        $sinhVienController->create();
        break;
    case 'sinhvien_store':
        $sinhVienController->store();
        break;
    case 'sinhvien_delete':
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
        $giangVienController->create();
        break;
    case 'giangvien_store':
        $giangVienController->store();
        break;
    case 'giangvien_delete':
        if (isset($_GET['id'])) {
            $giangVienController->delete($_GET['id']);
        } else {
            echo "Thiếu tham số id!";
        }
        break;

    // =================== USER (ĐĂNG NHẬP/ĐĂNG KÝ/ĐĂNG XUẤT) ===================
    case 'login':
        $userController->login();
        break;
    case 'register':
        $userController->register();
        break;
    case 'logout':
        $userController->logout();
        break;

    // =================== PHÂN CÔNG GIẢNG VIÊN HƯỚNG DẪN ===================
    case 'assign':
        $huongDanController->assign();
        break;
    case 'search':
        $huongDanController->searchLists();
        break;
    // =================== TRANG CHỦ THEO QUYỀN ===================
    case 'sv_home':
        $sinhVienController->home();
        break;
    case 'gv_home':
        include __DIR__ . '/../app/views/giangvien/gv_home.php';
        break;
    case 'admin_home':
        include __DIR__ . '/../app/views/user/admin_home.php';
        break;
        
    // =================== TRANG CHỦ MẶC ĐỊNH ===================
    case 'home':
    default:
        $title = "Trang Chủ";
        $content = '
            <div class="jumbotron">
                <h1 class="display-4">Chào mừng đến với Hệ thống Quản lý</h1>
                <p class="lead">Chọn chức năng bên trên để quản lý Sinh Viên và Giảng Viên.</p>
                <hr class="my-4">
                <p>Nếu chưa có tài khoản, hãy đăng ký ngay hoặc đăng nhập để tiếp tục.</p>
                <a class="btn btn-primary btn-lg" href="?action=register" role="button">Đăng ký</a>
                <a class="btn btn-success btn-lg" href="?action=login" role="button">Đăng nhập</a>
            </div>
        ';
        include __DIR__ . '/../app/views/layouts/main.php';
        break;
}
?>