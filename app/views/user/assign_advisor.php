<?php
$title = "Phân Công Giảng Viên Hướng Dẫn";
ob_start();
?>
<div class="container">
    <h2 class="mb-4">Phân Công Giảng Viên Hướng Dẫn cho Sinh Viên</h2>
    <!-- Form tìm kiếm và chọn sinh viên, giảng viên -->
    <form method="post" action="?action=assign">
        <div class="row">
            <!-- Phần tìm kiếm và chọn Sinh Viên -->
            <div class="col-md-6">
                <h4>Thông tin Sinh Viên</h4>
                <div class="form-group">
                    <label for="student_search_code">Tìm theo Mã Sinh Viên</label>
                    <input type="text" name="student_search_code" id="student_search_code" class="form-control"
                        placeholder="Nhập mã sinh viên"
                        value="<?= isset($student_search_code) ? htmlspecialchars($student_search_code) : '' ?>">
                </div>
                <div class="form-group">
                    <label for="student_search_name">Tìm theo Tên Sinh Viên</label>
                    <input type="text" name="student_search_name" id="student_search_name" class="form-control"
                        placeholder="Nhập tên sinh viên"
                        value="<?= isset($student_search_name) ? htmlspecialchars($student_search_name) : '' ?>">
                </div>
                <div class="form-group">
                    <label for="student_id">Chọn Sinh Viên</label>
                    <select name="student_id" id="student_id" class="form-control">
                        <?php if(isset($students) && count($students) > 0): ?>
                        <?php foreach($students as $student): ?>
                        <option value="<?= htmlspecialchars($student['SinhVienID']) ?>"
                            data-masinhvien="<?= htmlspecialchars($student['MaSinhVien']) ?>"
                            data-hotensv="<?= htmlspecialchars($student['HoTen']) ?>">
                            <?= htmlspecialchars($student['MaSinhVien'] . ' - ' . $student['HoTen']) ?>
                        </option>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <option value="">Không có sinh viên</option>
                        <?php endif; ?>
                    </select>
                </div>
                <!-- Các ô hiển thị thông tin sinh viên đã chọn -->
                <div class="form-group">
                    <label for="display_student_code">Mã Sinh Viên đã chọn</label>
                    <input type="text" id="display_student_code" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="display_student_name">Họ Tên Sinh Viên đã chọn</label>
                    <input type="text" id="display_student_name" class="form-control" readonly>
                </div>
            </div>
            <!-- Phần tìm kiếm và chọn Giảng Viên -->
            <div class="col-md-6">
                <h4>Thông tin Giảng Viên Hướng Dẫn</h4>
                <div class="form-group">
                    <label for="lecturer_search_code">Tìm theo Mã Giảng Viên</label>
                    <input type="text" name="lecturer_search_code" id="lecturer_search_code" class="form-control"
                        placeholder="Nhập mã giảng viên"
                        value="<?= isset($lecturer_search_code) ? htmlspecialchars($lecturer_search_code) : '' ?>">
                </div>
                <div class="form-group">
                    <label for="lecturer_search_name">Tìm theo Tên Giảng Viên</label>
                    <input type="text" name="lecturer_search_name" id="lecturer_search_name" class="form-control"
                        placeholder="Nhập tên giảng viên"
                        value="<?= isset($lecturer_search_name) ? htmlspecialchars($lecturer_search_name) : '' ?>">
                </div>
                <div class="form-group">
                    <label for="lecturer_id">Chọn Giảng Viên</label>
                    <select name="lecturer_id" id="lecturer_id" class="form-control">
                        <?php if(isset($lecturers) && count($lecturers) > 0): ?>
                        <?php foreach($lecturers as $lecturer): ?>
                        <option value="<?= htmlspecialchars($lecturer['GiangVienID']) ?>">
                            <?= htmlspecialchars($lecturer['MaGiangVien'] . ' - ' . $lecturer['HoTen']) ?>
                        </option>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <option value="">Không có giảng viên</option>
                        <?php endif; ?>
                    </select>
                </div>
            </div>
        </div>
        <!-- Nút Lưu -->
        <button type="submit" class="btn btn-success mt-3">Lưu Phân Công</button>
    </form>

    <!-- Hiển thị kết quả sau khi lưu (record vừa lưu) -->
    <?php if(isset($assignmentResult)): ?>
    <div class="mt-4">
        <h3>Kết quả phân công hướng dẫn</h3>
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Sinh Viên</th>
                    <th>Giảng Viên</th>
                    <th>Ngày Bắt Đầu</th>
                    <th>Ghi Chú</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <?= htmlspecialchars($assignmentResult['MaSinhVien'] ?? '') ?>
                        -
                        <?= htmlspecialchars($assignmentResult['HoTenSV'] ?? '') ?>
                    </td>
                    <td>
                        <?= htmlspecialchars($assignmentResult['MaGiangVien'] ?? '') ?>
                        -
                        <?= htmlspecialchars($assignmentResult['HoTenGV'] ?? '') ?>
                    </td>
                    <td><?= htmlspecialchars($assignmentResult['NgayBatDau'] ?? date('Y-m-d')) ?></td>
                    <td><?= htmlspecialchars($assignmentResult['GhiChu'] ?? '') ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <?php endif; ?>

    <!-- Hiển thị danh sách tất cả các phân công nếu có -->
    <?php if(isset($assignments) && count($assignments) > 0): ?>
    <div class="mt-4">
        <h3>Danh sách phân công hướng dẫn</h3>
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Sinh Viên</th>
                    <th>Giảng Viên</th>
                    <th>Ngày Bắt Đầu</th>
                    <th>Ghi Chú</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($assignments as $assign): ?>
                <tr>
                    <td><?= htmlspecialchars($assign['MaSinhVien'] . ' - ' . $assign['TenSinhVien']) ?></td>
                    <td><?= htmlspecialchars($assign['MaGiangVien'] . ' - ' . $assign['TenGiangVien']) ?></td>
                    <td><?= htmlspecialchars($assign['NgayBatDau']) ?></td>
                    <td><?= htmlspecialchars($assign['GhiChu']) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
?>

<script>
// Khi trang load xong, gán sự kiện change cho dropdown sinh viên
document.addEventListener('DOMContentLoaded', function() {
    var studentSelect = document.getElementById('student_id');
    var displayCode = document.getElementById('display_student_code');
    var displayName = document.getElementById('display_student_name');

    // Hàm cập nhật thông tin dựa trên option được chọn
    function updateStudentInfo() {
        var selectedOption = studentSelect.options[studentSelect.selectedIndex];
        var masinhvien = selectedOption.getAttribute('data-masinhvien') || '';
        var hotensv = selectedOption.getAttribute('data-hotensv') || '';
        displayCode.value = masinhvien;
        displayName.value = hotensv;
    }

    // Cập nhật ngay khi trang load
    updateStudentInfo();

    // Lắng nghe sự kiện thay đổi
    studentSelect.addEventListener('change', updateStudentInfo);
});
</script>