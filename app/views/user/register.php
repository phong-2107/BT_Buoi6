<?php
$title = "Đăng ký";
ob_start();
?>
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title">Đăng ký</h3>
            </div>
            <div class="card-body">
                <?php if (isset($error) && $error !== ""): ?>
                <div class="alert alert-danger"><?= $error ?></div>
                <?php endif; ?>
                <form method="POST" action="?action=register">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Mật khẩu</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="hoten">Họ tên</label>
                        <input type="text" name="hoten" id="hoten" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="sdt">Số điện thoại</label>
                        <input type="text" name="sdt" id="sdt" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="userType">Loại tài khoản</label>
                        <select name="userType" id="userType" class="form-control">
                            <option value="SinhVien">Sinh Viên</option>
                            <option value="GiangVien">Giảng Viên</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success btn-block">Đăng ký</button>
                </form>
            </div>
            <div class="card-footer text-center">
                <p>Đã có tài khoản? <a href="?action=login">Đăng nhập</a></p>
            </div>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';