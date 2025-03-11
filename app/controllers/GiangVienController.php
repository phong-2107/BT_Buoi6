<?php
require_once '../app/config/database.php';
require_once '../app/models/User.php';
require_once '../app/models/GiangVien.php';

class GiangVienController {
    private $userModel;
    private $gvModel;

    public function __construct() {
        $db = new Database();
        $conn = $db->getConnection();

        $this->userModel = new User($conn);
        $this->gvModel = new GiangVien($conn);
    }

    // Hiển thị danh sách giảng viên
    public function index() {
        $giangviens = $this->gvModel->getAll();
        require_once '../app/views/giangvien/index.php';
    }

    // Thêm giảng viên (form)
    public function create() {
        require_once '../app/views/giangvien/create.php';
    }

    // Xử lý thêm giảng viên
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
                    'GiangVien'
                );

                $this->gvModel->createGiangVien(
                    $userID,
                    $_POST['MaGiangVien'],
                    $_POST['BoMon']
                );

                header('Location: /giangvien/index');
            } else {
                echo "Username đã tồn tại!";
            }
        }
    }

    // Xóa giảng viên
    public function delete($id) {
        $this->gvModel->deleteGiangVien($id);
        header('Location: /giangvien/index');
    }
}