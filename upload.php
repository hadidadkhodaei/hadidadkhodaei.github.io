<?php
$uploadDir = "uploads/";

if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

$link = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['file']) && $_FILES['file']['error'] === 0) {
        $filename = basename($_FILES['file']['name']);
        $targetFile = $uploadDir . $filename;

        if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFile)) {
            $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http";
            $host = $_SERVER['HTTP_HOST'];
            $path = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            $link = "$protocol://$host$path/file.php?file=" . urlencode($filename);
        } else {
            $error = "مشکل در آپلود فایل.";
        }
    } else {
        $error = "فایلی انتخاب نشده یا خطا در فایل.";
    }
}
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8" />
    <title>آپلود فایل و دریافت لینک مستقیم</title>
    <style>
        body {
            direction: rtl;
            font-family: Tahoma, sans-serif;
            padding: 20px;
            max-width: 500px;
            margin: auto;
        }
        input, button {
            font-size: 16px;
            margin-top: 10px;
            width: 100%;
            padding: 8px;
        }
        .result {
            margin-top: 20px;
            background: #e0ffe0;
            padding: 10px;
            border: 1px solid #0a0;
            word-break: break-all;
        }
        .error {
            margin-top: 20px;
            background: #ffe0e0;
            padding: 10px;
            border: 1px solid #a00;
        }
    </style>
</head>
<body>
    <h1>آپلود فایل و دریافت لینک مستقیم</h1>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="file" required />
        <button type="submit">آپلود فایل</button>
    </form>

    <?php if ($link): ?>
        <div class="result">
            فایل آپلود شد! لینک مستقیم:<br />
            <a href="<?= htmlspecialchars($link) ?>" target="_blank"><?= htmlspecialchars($link) ?></a>
        </div>
    <?php elseif ($error): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
</body>
</html>
