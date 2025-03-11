<?php
// Dùng layout.php (nếu bạn có sẵn layout) hoặc hiển thị trực tiếp

ob_start();
?>
<h2>Đăng ký tài khoản</h2>
<form method="POST" action="?action=do_register">
    <label for="username">Tài khoản:</label><br>
    <input type="text" name="username" id="username" required><br><br>

    <label for="password">Mật khẩu:</label><br>
    <input type="password" name="password" id="password" required><br><br>

    <button type="submit">Đăng ký</button>
</form>
<p>
    Đã có tài khoản? <a href="?action=home">Đăng nhập</a>
</p>
<?php
$content = ob_get_clean();
$title = "Đăng ký tài khoản";
include __DIR__ . '/layouts/layout.php';