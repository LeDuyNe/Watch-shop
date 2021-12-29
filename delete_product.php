<?php
//  Kết nối database
include('../config.php');
session_start();
if (!isset($_SESSION['username'])) {
    header('location: ../login_submit.php');
}
// Lấy MSHH từ danh sách sang
$MSHH = $_GET['MSHH'];
$sql = "delete from hanghoa where MSHH = '$MSHH'";
//  thực thi
mysqli_query($conn, $sql);
//  quay lai danh sách
header('Location: /web_banhang/admin/index.php?page_layout=hanghoa');
?>