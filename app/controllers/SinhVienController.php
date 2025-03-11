<?php
require_once '../app/config/database.php';
require_once '../app/models/User.php';
require_once '../app/models/SinhVien.php';

class SinhVienController {
    private $userModel;
    private $svModel;

    public function __construct() {
        $db = new Database();
        $conn = $db->getConnection();

        $this->userModel = new User($conn);
        $this->svModel = new SinhVien($conn);
    }

    // Hiển thị danh sách sinh viên
    public function index() {
        $sinhviens = $this->svModel->getAll();
        require_once '../app/views/sinhvien/index.php';
    }

    // Thêm sinh viên (Hiển thị form)
    public function create() {
        require_once '../app/views/sinhvien/create.php';
    }

    // Xử lý thêm sinh viên
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['Username'];
            if (!$this->userModel->checkUserExists($username)) {
                $hashedPassword = password_hash($_POST['Password'], PASSWORD_DEFAULT);

                $userID = $this->userModel->createUser(
                    $username,
                    $hashedPassword,
                    $_POST['HoTen'],
                    $_POST['Email'],
                    $_POST['SoDienThoai'],
                    'SinhVien'
                );

                $this->svModel->createSinhVien(
                    $userID,
                    $_POST['MaSinhVien'],
                    $_POST['NgaySinh'],
                    $_POST['Lop']
                );

                header('Location: /sinhvien/index');
            } else {
                echo "Username đã tồn tại!";
            }
        }
    }

    // Xóa sinh viên theo ID
    public function delete($id) {
        $this->svModel->deleteSinhVien($id);
        header('Location: /sinhvien/index');
    }
}