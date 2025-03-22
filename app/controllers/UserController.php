<?php
require_once __DIR__ . '/../models/User.php';

class UserController {
    private $conn;
    private $userModel;

    public function __construct($conn) {
        $this->conn = $conn;
        $this->userModel = new User($conn);
    }

    // Hiển thị trang đăng nhập (chỉ GET)
    public function showLogin() {
        $error = "";
        include __DIR__ . '/../views/user/login.php';
    }

    // Xử lý đăng nhập (GET: show form; POST: xử lý form)
    public function login() {
        $error = "";
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            $user = $this->userModel->getUserByCredentials($username, $password);
            if ($user) {
                $_SESSION['user'] = $user;
                $_SESSION['user_id'] = $user['UserID'];
                $_SESSION['user_type'] = $user['UserType'];
                // Phân quyền chuyển hướng theo UserType
                if ($user['UserType'] === 'SinhVien') {
                    header("Location: ?action=sv_home");
                    exit();
                } elseif ($user['UserType'] === 'GiangVien') {
                    header("Location: ?action=gv_home");
                    exit();
                } elseif ($user['UserType'] === 'admin') {
                    header("Location: ?action=admin_home");
                    exit();
                } else {
                    header("Location: ?action=home");
                    exit();
                }
            } else {
                $error = "Sai username hoặc password!";
            }
        }
        include __DIR__ . '/../views/user/login.php';
    }

    // Hiển thị trang đăng ký (chỉ GET)
    public function showRegister() {
        $error = "";
        include __DIR__ . '/../views/user/register.php';
    }

    // Xử lý đăng ký (GET: show form; POST: xử lý form)
    public function register() {
        $error = "";
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            $hoten    = $_POST['hoten'] ?? '';
            $email    = $_POST['email'] ?? '';
            $sdt      = $_POST['sdt'] ?? '';
            $userType = $_POST['userType'] ?? 'SinhVien'; // Mặc định là SinhVien

            if ($this->userModel->checkUserExists($username)) {
                $error = "Username đã tồn tại!";
            } else {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $userID = $this->userModel->createUser($username, $hashedPassword, $hoten, $email, $sdt, $userType);
                $_SESSION['user_id'] = $userID;
                $_SESSION['user'] = [
                    'UserID'   => $userID,
                    'Username' => $username,
                    'UserType' => $userType
                ];
                $_SESSION['user_type'] = $userType;
                // Chuyển hướng theo loại tài khoản
                if ($userType === 'SinhVien') {
                    header("Location: ?action=sv_home");
                    exit();
                } elseif ($userType === 'GiangVien') {
                    header("Location: ?action=gv_home");
                    exit();
                } elseif ($userType === 'admin') {
                    header("Location: ?action=admin_home");
                    exit();
                } else {
                    header("Location: ?action=home");
                    exit();
                }
            }
        }
        include __DIR__ . '/../views/user/register.php';
    }

    // Đăng xuất
    public function logout() {
        session_destroy();
        header("Location: ?action=login");
        exit();
    }
}