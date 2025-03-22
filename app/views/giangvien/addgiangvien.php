<?php
$title = "Thêm Giảng viên";
ob_start();
?>
<div class="container">
    <h2>Thêm Giảng viên</h2>
    <form action="?action=giangvien_store" method="POST">
        <div class="form-group">
            <label for="Username">Tên đăng nhập</label>
            <input type="text" class="form-control" name="Username" id="Username" placeholder="Nhập tên đăng nhập"
                required>
        </div>
        <div class="form-group">
            <label for="Password">Mật khẩu</label>
            <input type="password" class="form-control" name="Password" id="Password" placeholder="Nhập mật khẩu"
                required>
        </div>
        <div class="form-group">
            <label for="HoTen">Họ tên</label>
            <input type="text" class="form-control" name="HoTen" id="HoTen" placeholder="Nhập họ tên" required>
        </div>
        <div class="form-group">
            <label for="Email">Email</label>
            <input type="email" class="form-control" name="Email" id="Email" placeholder="Nhập email" required>
        </div>
        <div class="form-group">
            <label for="SoDienThoai">Số điện thoại</label>
            <input type="text" class="form-control" name="SoDienThoai" id="SoDienThoai" placeholder="Nhập số điện thoại"
                required>
        </div>
        <div class="form-group">
            <label for="MaGiangVien">Mã Giảng viên</label>
            <input type="text" class="form-control" name="MaGiangVien" id="MaGiangVien" placeholder="Nhập mã giảng viên"
                required>
        </div>
        <div class="form-group">
            <label for="BoMon">Bộ môn</label>
            <input type="text" class="form-control" name="BoMon" id="BoMon" placeholder="Nhập bộ môn" required>
        </div>
        <button type="submit" class="btn btn-success btn-save">
            <i class="fas fa-save"></i> Thêm Giảng viên
        </button>
    </form>
    <a class="back-link" href="?action=giangvien_index">Quay lại danh sách</a>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
?>