<?php
$targetDir = "uploads/";
if (!is_dir($targetDir)) {
    mkdir($targetDir, 0755, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['file'])) {
        $file = $_FILES['file'];
        $targetFile = $targetDir . basename($file['name']);

        if (move_uploaded_file($file['tmp_name'], $targetFile)) {
            $url = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']) . "/" . $targetFile;
            echo "فایل با موفقیت آپلود شد.<br>";
            echo "لینک مستقیم: <a href=\"$url\">$url</a>";
        } else {
            echo "مشکل در آپلود فایل.";
        }
    } else {
        echo "فایلی ارسال نشده.";
    }
}
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8" />
    <title>آپلود فایل ساده</title>
    <style>
        body { direction: rtl; font-family: Tahoma, sans-serif; padding: 20px; }
        input, button { font-size: 16px; }
    </style>
</head>
<body>
    <h1>آپلود فایل</h1>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="file" required />
        <button type="submit">آپلود</button>
    </form>
</body>
</html>
