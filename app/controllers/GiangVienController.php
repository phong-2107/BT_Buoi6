<?php
require_once __DIR__ . '/../models/GiangVien.php';
require_once __DIR__ . '/../models/User.php';

class GiangVienController {
    private $conn;
    private $gvModel;
    private $userModel;

    public function __construct($conn) {
        $this->conn = $conn;
        // Khởi tạo model với PDO được tiêm vào
        $this->gvModel = new GiangVien($conn);
        $this->userModel = new User($conn);
    }

    // Hiển thị danh sách giảng viên
    public function index() {
        $giangviens = $this->gvModel->getAll();
        include __DIR__ . '/../views/giangvien/index.php';
    }

    // Hiển thị form tạo giảng viên
    public function create() {
        include __DIR__ . '/../views/giangvien/addgiangvien.php';
    }

    // Xử lý thêm giảng viên (POST form)
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['Username'];
            if (!$this->userModel->checkUserExists($username)) {
                $hashedPassword = password_hash($_POST['Password'], PASSWORD_DEFAULT);

                // Tạo user mới cho giảng viên
                $userID = $this->userModel->createUser(
                    $username,
                    $hashedPassword,
                    $_POST['HoTen'],
                    $_POST['Email'],
                    $_POST['SoDienThoai'],
                    'GiangVien'
                );

                // Tạo thông tin giảng viên
                $this->gvModel->createGiangVien(
                    $userID,
                    $_POST['MaGiangVien'],
                    $_POST['BoMon']
                );

                header("Location: ?action=giangvien_index");
                exit();
            } else {
                echo "<p style='color:red;text-align:center'>Username đã tồn tại!</p>";
            }
        }
    }

    // Xóa giảng viên theo ID
    public function delete($id) {
        $this->gvModel->deleteGiangVien($id);
        header("Location: ?action=giangvien_index");
        exit();
    }
}