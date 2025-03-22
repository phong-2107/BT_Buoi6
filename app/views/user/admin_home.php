<?php
$title = "Trang chủ Admin";
ob_start();
?>
<div class="jumbotron">
    <h1 class="display-4">Chào mừng Admin!</h1>
    <p class="lead">Đây là trang quản trị hệ thống. Tại đây, bạn có thể quản lý người dùng, cấu hình hệ thống và thực
        hiện các tác vụ quản trị khác.</p>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';