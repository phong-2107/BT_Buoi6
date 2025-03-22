<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thesis Management</title>
    <!-- Liên kết CSS Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
    body {
        margin: 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    header {
        background: linear-gradient(to right, #2196f3, #fdd835);
        color: white;
        padding: 0 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        height: 60px;
    }

    .logo {
        display: flex;
        align-items: center;
        margin-right: 20px;
    }

    .logo i {
        font-size: 40px;
        margin-right: 10px;
        color: white;
    }

    .nav-container {
        display: flex;
        align-items: center;
        flex-grow: 1;
    }

    nav ul {
        list-style: none;
        display: flex;
        margin: 0;
        padding: 0;
    }

    nav ul li {
        position: relative;
        margin-left: 20px;
    }

    nav ul li a {
        text-decoration: none;
        color: white;
        font-weight: 500;
        padding: 8px 12px;
        transition: background 0.3s;
    }

    nav ul li a:hover {
        background: rgba(255, 255, 255, 0.2);
        border-radius: 5px;
    }

    nav ul li ul.dropdown {
        display: none;
        position: absolute;
        background-color: white;
        color: black;
        top: 100%;
        left: 0;
        min-width: 150px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border-radius: 4px;
        z-index: 10;
    }

    nav ul li:hover ul.dropdown {
        display: block;
    }

    nav ul li ul.dropdown li a {
        color: #333;
        padding: 10px;
        display: block;
    }

    nav ul li ul.dropdown li a:hover {
        background-color: #f1f1f1;
    }

    .auth-links {
        display: flex;
        gap: 10px;
    }

    .auth-links a {
        text-decoration: none;
        color: white;
        font-weight: bold;
        padding: 6px 12px;
        border-radius: 4px;
        transition: background 0.3s;
    }

    .auth-links a:hover {
        background: rgba(255, 255, 255, 0.2);
    }

    footer {
        background-color: #f5f5f5;
        padding: 20px;
        text-align: center;
        font-size: 14px;
        color: #666;
        margin-top: 40px;
        border-top: 1px solid #ddd;
    }
    </style>
</head>

<body>
    <!-- <?php session_start(); ?> -->
    <header>
        <div class="logo">
            <i class="fas fa-book"></i>
        </div>
        <div class="nav-container">
            <nav>
                <ul>
                    <?php if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'SinhVien'): ?>
                    <li><a href="?action=quanly">Quản lý</a>
                        <ul class="dropdown">
                            <li><a href="?action=sv_home">Sinh viên</a></li>
                            <li><a href="?action=doan_index">Đồ án</a></li>
                            <li><a href="?action=giangvien_index">Giảng viên</a></li>
                        </ul>
                    </li>
                    <li><a href="?action=assign">Sắp Xếp</a>
                    </li>
                    <?php endif; ?>
                    <li><a href="?action=tracuu">Tra cứu</a>
                        <ul class="dropdown">
                            <li><a href="?action=gvhuongdan">Giáo viên hướng dẫn</a></li>
                            <li><a href="?action=giangvien_index">Giảng viên</a></li>
                        </ul>
                    </li>
                    <!-- <li><a href="?action=about">About Us</a></li> -->
                </ul>
            </nav>
        </div>
        <div class="auth-links">
            <?php if (isset($_SESSION['user_type'])): ?>
            <a href="?action=logout">Đăng xuất</a>
            <?php else: ?>
            <!-- <a href="?action=register">Đăng ký</a> -->
            <a href="?action=login">Đăng nhập</a>
            <?php endif; ?>
        </div>
    </header>

    <main style="padding: 20px;">
        <!-- Nội dung trang sẽ nằm ở đây -->
        <?= isset($content) ? $content : "" ?>
    </main>

    <footer>
        <p>&copy; 2025 Ambatocam Management System. All rights reserved.</p>
        <p>Liên hệ: thesis@university.edu | SĐT: (0123) 456-789</p>
    </footer>


    <!-- Liên kết JS Bootstrap cùng jQuery và Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>