<!-- views/sinhvien/edit.php -->
<?php
$title = "Danh sách Sinh Viên";
ob_start();
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Cập nhật Sinh viên</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
    body {
        font-family: 'Segoe UI', sans-serif;
        background-color: #f4f6f9;
        padding: 30px;
        margin: 0;
    }

    .container {
        max-width: 700px;
        margin: auto;
        background: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
        margin-bottom: 30px;
    }

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
        <h2>Cập nhật thông tin Sinh viên</h2>
        <form action="?action=sinhvien_update" method="POST">
            <input type="hidden" name="Id" value="<?= htmlspecialchars($sinhvien['Id']) ?>">

            <label for="HoTen">Họ tên</label>
            <input type="text" name="HoTen" id="HoTen" value="<?= htmlspecialchars($sinhvien['HoTen']) ?>" required>

            <label for="Email">Email</label>
            <input type="email" name="Email" id="Email" value="<?= htmlspecialchars($sinhvien['Email']) ?>" required>

            <label for="SoDienThoai">Số điện thoại</label>
            <input type="text" name="SoDienThoai" id="SoDienThoai"
                value="<?= htmlspecialchars($sinhvien['SoDienThoai']) ?>" required>

            <label for="MaSinhVien">Mã sinh viên</label>
            <input type="text" name="MaSinhVien" id="MaSinhVien"
                value="<?= htmlspecialchars($sinhvien['MaSinhVien']) ?>" required>

            <label for="NgaySinh">Ngày sinh</label>
            <input type="date" name="NgaySinh" id="NgaySinh" value="<?= htmlspecialchars($sinhvien['NgaySinh']) ?>"
                required>

            <label for="Lop">Lớp</label>
            <input type="text" name="Lop" id="Lop" value="<?= htmlspecialchars($sinhvien['Lop']) ?>" required>

            <button type="submit"><i class="fas fa-save"></i> Cập nhật sinh viên</button>
        </form>

        <a class="back-link" href="?action=sinhvien_index">Quay lại danh sách</a>
    </div>
</body>

</html>

</html>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
?>