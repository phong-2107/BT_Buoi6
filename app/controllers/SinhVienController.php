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

    // Hiển thị danh sách sinh viên
    public function index() {
        $sinhviens = $this->svModel->getAll();
        include __DIR__ . '/../views/sinhvien/index.php';
    }

    // Hiển thị form tạo sinh viên
    public function create() {
        include __DIR__ . '/../views/sinhvien/create.php';
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

    // Xóa sinh viên theo ID
    public function delete($id) {
        $this->svModel->deleteSinhVien($id);
        header("Location: ?action=sinhvien_index");
        exit();
    }
}