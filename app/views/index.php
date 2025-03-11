<?php
// Bắt đầu cơ chế "ghi nhớ" output để gắn vào $content
ob_start();
?>
<h2>Đăng nhập</h2>
<form method="POST" action="?action=login">
    <label for="username">Tài khoản:</label>
    <input type="text" name="username" id="username" required><br><br>

    <label for="password">Mật khẩu:</label>
    <input type="password" name="password" id="password" required><br><br>

    <button type="submit">Đăng nhập</button>
</form>
<!-- Nút chuyển sang trang đăng ký -->
<p style="text-align:center; margin-top:20px;">
    Chưa có tài khoản?
    <input type="button" value="Đăng ký" onclick="window.location.href='?action=register';" />
</p>
<?php
// Kết thúc "ghi nhớ" output, gán cho biến $content
$content = ob_get_clean();
$title = "Trang Đăng Nhập";
// Gọi layout
include __DIR__ . '/layouts/layout.php';