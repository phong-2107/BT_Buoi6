<?php
require_once __DIR__ . '/../models/SinhVien.php';
require_once __DIR__ . '/../models/GiangVien.php';
require_once __DIR__ . '/../models/SinhVienGiangVienHuongDan.php';

class HuongDanController {
    private $conn;
    private $sinhVienModel;
    private $giangVienModel;
    private $huongDanModel;

    public function __construct($conn) {
        $this->conn = $conn;
        $this->sinhVienModel = new SinhVien($conn);
        $this->giangVienModel = new GiangVien($conn);
        $this->huongDanModel = new SinhVienGiangVienHuongDan($conn);
    }

    /**
     * Action assign: xử lý lưu phân công kết hợp với chức năng tìm kiếm.
     * Nếu là POST và có chọn Sinh Viên – Giảng Viên, thực hiện lưu bản ghi.
     * Sau đó, hiển thị lại view với danh sách được lọc.
     */
    public function assign() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy dữ liệu từ form (dùng POST)
            $student_search_code  = trim($_POST['student_search_code'] ?? '');
            $student_search_name  = trim($_POST['student_search_name'] ?? '');
            $lecturer_search_code = trim($_POST['lecturer_search_code'] ?? '');
            $lecturer_search_name = trim($_POST['lecturer_search_name'] ?? '');
            $student_id           = $_POST['student_id'] ?? '';
            $lecturer_id          = $_POST['lecturer_id'] ?? '';

            // Lấy danh sách đầy đủ từ model
            $students  = $this->sinhVienModel->getAll();
            $lecturers = $this->giangVienModel->getAll();

            // Áp dụng bộ lọc cho Sinh Viên nếu có tiêu chí tìm kiếm
            if ($student_search_code || $student_search_name) {
                $students = array_filter($students, function($student) use ($student_search_code, $student_search_name) {
                    $matchCode = $student_search_code ? (stripos($student['MaSinhVien'], $student_search_code) !== false) : true;
                    $matchName = $student_search_name ? (stripos($student['HoTen'], $student_search_name) !== false) : true;
                    return $matchCode && $matchName;
                });
            }

            // Áp dụng bộ lọc cho Giảng Viên nếu có tiêu chí tìm kiếm
            if ($lecturer_search_code || $lecturer_search_name) {
                $lecturers = array_filter($lecturers, function($lecturer) use ($lecturer_search_code, $lecturer_search_name) {
                    $matchCode = $lecturer_search_code ? (stripos($lecturer['MaGiangVien'], $lecturer_search_code) !== false) : true;
                    $matchName = $lecturer_search_name ? (stripos($lecturer['HoTen'], $lecturer_search_name) !== false) : true;
                    return $matchCode && $matchName;
                });
            }

            // Nếu có dữ liệu POST và chọn Sinh Viên & Giảng Viên, lưu bản ghi
            $assignmentResult = null;
            if (!empty($student_id) && !empty($lecturer_id)) {
                $assignmentId = $this->huongDanModel->create($student_id, $lecturer_id, date('Y-m-d'), '');
                $studentDetail = $this->sinhVienModel->get($student_id);
                $lecturerDetail = null;
                foreach ($lecturers as $lecturer) {
                    if ($lecturer['GiangVienID'] == $lecturer_id) {
                        $lecturerDetail = $lecturer;
                        break;
                    }
                }
                $assignmentResult = [
                    'MaSinhVien'  => $studentDetail['MaSinhVien'] ?? '',
                    'HoTenSV'     => $studentDetail['HoTen'] ?? '',
                    'MaGiangVien' => $lecturerDetail['MaGiangVien'] ?? '',
                    'HoTenGV'     => $lecturerDetail['HoTen'] ?? '',
                    'NgayBatDau'  => date('Y-m-d'),
                    'GhiChu'      => ''
                ];
            }
            // Lấy danh sách phân công hiện có
            $assignments = $this->huongDanModel->getAll();
            include __DIR__ . '/../views/user/assign_advisor.php';
        } else {
            // Nếu không có POST, gọi hàm searchLists để chỉ thực hiện tìm kiếm và hiển thị danh sách
            $this->searchLists();
        }
    }

    /**
     * Function searchLists: chỉ thực hiện chức năng tìm kiếm và hiển thị danh sách Sinh Viên và Giảng Viên.
     */
    public function searchLists() {
        $student_search_code  = trim($_GET['student_search_code'] ?? '');
        $student_search_name  = trim($_GET['student_search_name'] ?? '');
        $lecturer_search_code = trim($_GET['lecturer_search_code'] ?? '');
        $lecturer_search_name = trim($_GET['lecturer_search_name'] ?? '');

        $students  = $this->sinhVienModel->getAll();
        $lecturers = $this->giangVienModel->getAll();

        if ($student_search_code || $student_search_name) {
            $students = array_filter($students, function($student) use ($student_search_code, $student_search_name) {
                $matchCode = $student_search_code ? (stripos($student['MaSinhVien'], $student_search_code) !== false) : true;
                $matchName = $student_search_name ? (stripos($student['HoTen'], $student_search_name) !== false) : true;
                return $matchCode && $matchName;
            });
        }

        if ($lecturer_search_code || $lecturer_search_name) {
            $lecturers = array_filter($lecturers, function($lecturer) use ($lecturer_search_code, $lecturer_search_name) {
                $matchCode = $lecturer_search_code ? (stripos($lecturer['MaGiangVien'], $lecturer_search_code) !== false) : true;
                $matchName = $lecturer_search_name ? (stripos($lecturer['HoTen'], $lecturer_search_name) !== false) : true;
                return $matchCode && $matchName;
            });
        }

        $assignmentResult = null;
        $assignments = $this->huongDanModel->getAll();
        include __DIR__ . '/../views/user/assign_advisor.php';
    }
}
?>