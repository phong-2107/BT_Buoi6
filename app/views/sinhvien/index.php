<?php
$title = "Danh sách Sinh Viên";
ob_start();
?>
<div class="d-flex justify-content-between mb-3">
    <h2>Danh sách Sinh Viên</h2>
    <a href="?action=sinhvien_create" class="btn btn-primary">Thêm Sinh Viên</a>
</div>
<table class="table table-bordered table-striped">
    <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>Mã Sinh Viên</th>
            <th>Họ Tên</th>
            <th>Ngày Sinh</th>
            <th>Lớp</th>
            <th>Email</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php if(isset($sinhviens) && count($sinhviens) > 0): ?>
        <?php foreach($sinhviens as $sv): ?>
        <tr>
            <td><?= htmlspecialchars($sv['SinhVienID']) ?></td>
            <td><?= htmlspecialchars($sv['MaSinhVien']) ?></td>
            <td><?= htmlspecialchars($sv['HoTen']) ?></td>
            <td><?= htmlspecialchars($sv['NgaySinh']) ?></td>
            <td><?= htmlspecialchars($sv['Lop']) ?></td>
            <td><?= htmlspecialchars($sv['Email']) ?></td>
            <td>
                <a href="?action=sinhvien_delete&id=<?= $sv['SinhVienID'] ?>" class="btn btn-danger btn-sm"
                    onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a>
            </td>
        </tr>
        <?php endforeach; ?>
        <?php else: ?>
        <tr>
            <td colspan="7" class="text-center">Không có dữ liệu</td>
        </tr>
        <?php endif; ?>
    </tbody>
</table>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
?>