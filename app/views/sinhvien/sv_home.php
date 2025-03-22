<?php
$title = "Trang chủ Sinh viên";
ob_start();
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Quản lý sinh viên</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
    body {
        font-family: 'Segoe UI', sans-serif;
        margin: 0;
        padding: 20px;
        background: #f7f7f7;
    }

    h2 {
        margin-bottom: 20px;
    }

    .toolbar {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
    }

    .toolbar input[type="text"] {
        padding: 8px 12px;
        width: 250px;
        border: 1px solid #ccc;
        border-radius: 6px;
    }

    .toolbar button {
        background-color: #2196f3;
        color: white;
        padding: 8px 14px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-weight: bold;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background: white;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        border-radius: 6px;
        overflow: hidden;
    }

    table th,
    table td {
        padding: 12px;
        border-bottom: 1px solid #eee;
        text-align: left;
    }

    table th {
        background-color: #f0f0f0;
    }

    .actions button {
        margin-right: 6px;
        padding: 6px 10px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .edit-btn {
        background-color: #ffc107;
        color: #333;
    }

    .delete-btn {
        background-color: #f44336;
        color: white;
    }

    .edit-btn:hover {
        background-color: #e0a800;
    }

    .delete-btn:hover {
        background-color: #d32f2f;
    }
    </style>
</head>

<body>
    <h2>Quản lý Sinh viên</h2>
    <div class="toolbar">
        <input type="text" placeholder="Tìm kiếm sinh viên...">
        <button onclick="location.href='?action=sinhvien_create'"><i class="fas fa-plus"></i> Thêm sinh viên</button>
    </div>

    <table>
        <thead>
            <tr>
                <th>STT</th>
                <th>Mã SV</th>
                <th>Họ tên</th>
                <th>Ngày sinh</th>
                <th>Lớp</th>
                <th>Email</th>
                <th>SĐT</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($sinhviens)) : ?>
            <?php foreach ($sinhviens as $index => $sv) : ?>
            <tr>
                <td><?= $index + 1 ?></td>
                <td><?= htmlspecialchars($sv['MaSinhVien']) ?></td>
                <td><?= htmlspecialchars($sv['HoTen']) ?></td>
                <td><?= htmlspecialchars($sv['NgaySinh']) ?></td>
                <td><?= htmlspecialchars($sv['Lop']) ?></td>
                <td><?= htmlspecialchars($sv['Email']) ?></td>
                <td><?= htmlspecialchars($sv['SoDienThoai'] ?? '') ?></td>
                <td class="actions">
                    <button class="edit-btn" onclick="location.href='?action=sinhvien_edit&id=<?= $sv['UserID'] ?>'">✏️
                        Sửa</button>
                    <button class="delete-btn"
                        onclick="if(confirm('Bạn có chắc chắn muốn xóa?')) location.href='?action=sinhvien_delete&id=<?= $sv['UserID'] ?>'">🗑
                        Xóa</button>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php else : ?>
            <tr>
                <td colspan="8" style="text-align:center">Không có dữ liệu sinh viên.</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>

</html>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';