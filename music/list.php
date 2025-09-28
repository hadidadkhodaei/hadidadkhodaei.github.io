<?php
$files = array_merge(
  glob("*.mp3"),
  glob("*.MP3")
);
echo json_encode($files);
?>
