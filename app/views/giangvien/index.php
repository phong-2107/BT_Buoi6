<?php
$title = "Danh sách Giảng Viên";
ob_start();
?>
<div class="d-flex justify-content-between mb-3">
    <h2>Danh sách Giảng Viên</h2>
    <a href="?action=giangvien_create" class="btn btn-primary">Thêm Giảng Viên</a>
</div>
<table class="table table-bordered table-striped">
    <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>Mã Giảng Viên</th>
            <th>Họ Tên</th>
            <th>Email</th>
            <th>Bộ Môn</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php if(isset($giangviens) && count($giangviens) > 0): ?>
        <?php foreach($giangviens as $gv): ?>
        <tr>
            <td><?= htmlspecialchars($gv['GiangVienID']) ?></td>
            <td><?= htmlspecialchars($gv['MaGiangVien']) ?></td>
            <td><?= htmlspecialchars($gv['HoTen']) ?></td>
            <td><?= htmlspecialchars($gv['Email']) ?></td>
            <td><?= htmlspecialchars($gv['BoMon']) ?></td>
            <td>
                <a href="?action=giangvien_delete&id=<?= $gv['GiangVienID'] ?>" class="btn btn-danger btn-sm"
                    onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a>
            </td>
        </tr>
        <?php endforeach; ?>
        <?php else: ?>
        <tr>
            <td colspan="6" class="text-center">Không có dữ liệu</td>
        </tr>
        <?php endif; ?>
    </tbody>
</table>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
?>