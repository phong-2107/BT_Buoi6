<?php
$title = "Trang chủ Giảng viên";
ob_start();
?>
<div class="jumbotron">
    <h1 class="display-4">Chào mừng Giảng viên!</h1>
    <p class="lead">Đây là trang chủ dành cho Giảng viên. Tại đây, bạn có thể quản lý các bài giảng, sinh viên và các
        công việc liên quan.</p>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';