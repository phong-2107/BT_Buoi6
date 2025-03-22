<?php
require_once __DIR__ . '/../models/SinhVien.php';
require_once __DIR__ . '/../models/User.php';

class SinhVienController {
    private $conn;
    private $svModel;
    private $userModel;

    public function __construct($conn) {
        $this->conn = $conn;
        // Khởi tạo model với PDO được tiêm vào
        $this->svModel = new SinhVien($conn);
        $this->userModel = new User($conn);
    }

    // Phương thức hiển thị thông tin sinh viên lên trang chủ của Sinh viên (sv_home.php)
    public function home() {
        // Lấy tất cả sinh viên
        $sinhviens = $this->svModel->getAll();
        // echo "Bảng SinhVien có " . count($sinhviens) . " sinh viên.";
        // Include view trang chủ dành cho Sinh viên
        include __DIR__ . '/../views/sinhvien/sv_home.php';
    }

    // Phương thức hiển thị danh sách sinh viên (dành cho Admin, quản lý chung, ...)
    public function index() {
        $sinhviens = $this->svModel->getAll();
        include __DIR__ . '/../views/sinhvien/index.php';
    }

    // Hiển thị form tạo sinh viên
    public function create() {
        include __DIR__ . '/../views/sinhvien/addsinhvien.php';
    }

    // Xử lý thêm sinh viên (POST form)
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['Username'];
            if (!$this->userModel->checkUserExists($username)) {
                $hashedPassword = password_hash($_POST['Password'], PASSWORD_DEFAULT);

                // Tạo user mới cho sinh viên
                $userID = $this->userModel->createUser(
                    $username,
                    $hashedPassword,
                    $_POST['HoTen'],
                    $_POST['Email'],
                    $_POST['SoDienThoai'],
                    'SinhVien'
                );

                // Tạo thông tin sinh viên
                $this->svModel->createSinhVien(
                    $userID,
                    $_POST['MaSinhVien'],
                    $_POST['NgaySinh'],
                    $_POST['Lop']
                );

                header("Location: ?action=sinhvien_index");
                exit();
            } else {
                echo "<p style='color:red;text-align:center'>Username đã tồn tại!</p>";
            }
        }
    }


    // Hiển thị form chỉnh sửa sinh viên (GET)
    public function edit($id) {
        // Lấy thông tin sinh viên theo ID (giả sử trả về mảng có các trường: Id, UserID, HoTen, Email, SoDienThoai, MaSinhVien, NgaySinh, Lop)
        $sinhvien = $this->svModel->getById($id);
        include __DIR__ . '/../views/sinhvien/edit.php';
    }

    // Xử lý cập nhật sinh viên (POST)
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['Id'];
            // Lấy thông tin mới từ form
            $hoTen = $_POST['HoTen'];
            $email = $_POST['Email'];
            $sdt = $_POST['SoDienThoai'];
            $maSinhVien = $_POST['MaSinhVien'];
            $ngaySinh = $_POST['NgaySinh'];
            $lop = $_POST['Lop'];

            // Lấy thông tin cũ để lấy UserID
            $sinhvien = $this->svModel->get($id);
            $userId = $sinhvien['UserID'];

            // Cập nhật thông tin chung trong bảng Users (giả sử updateUser được định nghĩa)
            $this->userModel->updateUser($userId, $hoTen, $email, $sdt);

            // Cập nhật thông tin sinh viên trong bảng SinhVien
            $this->svModel->updateSinhVien($id, $maSinhVien, $ngaySinh, $lop);

            header("Location: ?action=sinhvien_index");
            exit();
        }
    }


    // Xóa sinh viên theo ID
    public function delete($id) {
        $this->svModel->deleteSinhVien($id);
        header("Location: ?action=sinhvien_index");
        exit();
    }
}