<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title><?php echo $title ?? "Website Trắc Nghiệm"; ?></title>
    <style>
    /* Ví dụ CSS đơn giản */
    body {
        font-family: sans-serif;
        margin: 0;
        padding: 0;
    }

    header,
    footer {
        background: #f2f2f2;
        text-align: center;
        padding: 15px;
    }

    main {
        margin: 20px;
    }

    .container {
        max-width: 800px;
        margin: 0 auto;
    }
    </style>
</head>

<body>
    <header>
        <h1>Hệ thống thi trắc nghiệm</h1>
    </header>
    <main class="container">
        <!-- Nội dung của mỗi trang sẽ được "nhúng" vào đây -->
        <?php echo $content ?? ''; ?>
    </main>
    <footer>
        <p>&copy; 2025 - Thi trắc nghiệm</p>
    </footer>
</body>

</html>