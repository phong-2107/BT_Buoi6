<?php
$title = "Thêm Sinh Viên";
ob_start();
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Thêm Sinh viên</title>
    <style>
    form label {
        display: block;
        margin-bottom: 6px;
        font-weight: 600;
    }

    form input,
    form select {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 6px;
    }

    form button {
        padding: 10px 20px;
        background-color: #4caf50;
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-weight: bold;
        display: block;
        margin: auto;
    }

    form button:hover {
        background-color: #388e3c;
    }

    .back-link {
        display: block;
        text-align: center;
        margin-top: 20px;
        color: #2196f3;
        text-decoration: none;
    }
    </style>
</head>

<body>
    <div class="container">
        <h2>Thêm Sinh viên</h2>
        <form action="?action=sinhvien_store" method="POST">
            <label for="HoTen">Họ tên</label>
            <input type="text" name="HoTen" id="HoTen" value="" required>

            <label for="Email">Email</label>
            <input type="email" name="Email" id="Email" value="" required>

            <label for="SoDienThoai">Số điện thoại</label>
            <input type="text" name="SoDienThoai" id="SoDienThoai" value="" required>

            <label for="MaSinhVien">Mã sinh viên</label>
            <input type="text" name="MaSinhVien" id="MaSinhVien" value="" required>

            <label for="NgaySinh">Ngày sinh</label>
            <input type="date" name="NgaySinh" id="NgaySinh" value="" required>

            <label for="Lop">Lớp</label>
            <input type="text" name="Lop" id="Lop" value="" required>

            <button type="submit"><i class="fas fa-save"></i> Thêm sinh viên</button>
        </form>

        <a class="back-link" href="?action=sv_home">Quay lại danh sách</a>
    </div>
</body>

</html>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
?>