<?php
$mysqli = new mysqli("localhost", "root", "", "xeonline");
if ($mysqli->connect_error) {
    die("Lỗi: " . $mysqli->connect_error);
}
echo "✅ Kết nối CSDL thành công!";
?>