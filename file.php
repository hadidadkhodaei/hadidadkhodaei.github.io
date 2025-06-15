<?php
$uploadDir = 'uploads/';

if (!isset($_GET['file'])) {
    http_response_code(400);
    echo 'نام فایل مشخص نشده.';
    exit;
}

$filename = basename($_GET['file']);
$filepath = $uploadDir . $filename;

if (!file_exists($filepath)) {
    http_response_code(404);
    echo 'فایل پیدا نشد.';
    exit;
}

$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mime = finfo_file($finfo, $filepath);
finfo_close($finfo);

header('Content-Type: ' . $mime);
header('Content-Length: ' . filesize($filepath));
header('Content-Disposition: inline; filename="' . $filename . '"');

readfile($filepath);
exit;
?>
