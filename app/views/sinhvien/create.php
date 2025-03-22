\<?php
$title = "Thêm Sinh Viên";
ob_start();
?>
<div class="card">
    <div class="card-header">
        <h2>Thêm Sinh Viên</h2>
    </div>
    <div class="card-body">
        <form action="?action=sinhvien_store" method="POST">
            <div class="form-group">
                <label for="Username">Username</label>
                <input type="text" class="form-control" name="Username" id="Username" required>
            </div>
            <div class="form-group">
                <label for="Password">Mật khẩu</label>
                <input type="password" class="form-control" name="Password" id="Password" required>
            </div>
            <div class="form-group">
                <label for="HoTen">Họ Tên</label>
                <input type="text" class="form-control" name="HoTen" id="HoTen" required>
            </div>
            <div class="form-group">
                <label for="Email">Email</label>
                <input type="email" class="form-control" name="Email" id="Email" required>
            </div>
            <div class="form-group">
                <label for="SoDienThoai">Số điện thoại</label>
                <input type="text" class="form-control" name="SoDienThoai" id="SoDienThoai">
            </div>
            <div class="form-group">
                <label for="MaSinhVien">Mã Sinh Viên</label>
                <input type="text" class="form-control" name="MaSinhVien" id="MaSinhVien" required>
            </div>
            <div class="form-group">
                <label for="NgaySinh">Ngày Sinh</label>
                <input type="date" class="form-control" name="NgaySinh" id="NgaySinh" required>
            </div>
            <div class="form-group">
                <label for="Lop">Lớp</label>
                <input type="text" class="form-control" name="Lop" id="Lop" required>
            </div>
            <button type="submit" class="btn btn-success">Thêm</button>
        </form>
    </div>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
?>