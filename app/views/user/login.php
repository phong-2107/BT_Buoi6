<?php
$title = "Đăng nhập";
ob_start();
?>

<div class="content">
    <div class="container">
        <div class="row">
            <!-- Cột bên trái: hình ảnh minh họa (chỉ hiển thị trên màn hình trung và lớn) -->
            <div class="col-md-6 d-none d-md-block">
                <img src="images/undraw_remotely_2j6y.svg" alt="Image" class="img-fluid">
            </div>
            <!-- Cột bên phải: form đăng nhập -->
            <div class="col-md-6 contents">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="mb-4">
                            <h3>Đăng nhập</h3>
                            <p class="mb-4">Chào mừng bạn trở lại, vui lòng đăng nhập để tiếp tục.</p>
                        </div>
                        <!-- Hiển thị thông báo lỗi nếu có -->
                        <?php if (isset($error) && $error !== ""): ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                        <?php endif; ?>
                        <form method="POST" action="?action=login">
                            <div class="form-group first">
                                <label for="username">Username</label>
                                <input type="text" name="username" class="form-control" id="username"
                                    placeholder="Nhập username" required>
                            </div>
                            <div class="form-group last mb-4">
                                <label for="password">Mật khẩu</label>
                                <input type="password" name="password" class="form-control" id="password"
                                    placeholder="Nhập mật khẩu" required>
                            </div>
                            <div class="d-flex mb-5 align-items-center">
                                <label class="control control--checkbox mb-0">
                                    <span class="caption">Remember me</span>
                                    <input type="checkbox" name="remember" checked="checked" />
                                    <div class="control__indicator"></div>
                                </label>
                                <span class="ml-auto"><a href="?action=forgot" class="forgot-pass">Quên mật
                                        khẩu</a></span>
                            </div>
                            <input type="submit" value="Đăng nhập" class="btn btn-block btn-primary">
                            <span class="d-block text-left my-4 text-muted">&mdash; or login with &mdash;</span>
                            <div class="social-login">
                                <a href="#" class="facebook">
                                    <span class="icon-facebook mr-3"></span>
                                </a>
                                <a href="#" class="twitter">
                                    <span class="icon-twitter mr-3"></span>
                                </a>
                                <a href="#" class="google">
                                    <span class="icon-google mr-3"></span>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
?>