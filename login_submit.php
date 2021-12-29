
<?php
session_start();
if (isset($_SESSION['username'])) {
    header('location:./admin/index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Css favi -->
    <link rel="icon" href="assets/img/favi.png" type="image/x-icon" />
    <!-- Reset CSS -->
    <link rel="" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="assets/css/base.css">
    <title>Trang đăng nhập</title>
</head>

<body>



    <div class="login-box">
        <h2>Đăng Nhập</h2>
        <form name="login" action="/web_banhang/admin/index.php" method="POST">
            <div class="login-info">
                <?php if(isset($_SESSION['userError'])) {echo $_SESSION['userError'];}?>
            </div>
            <div class="user-box">
                <input type="text" name="txtUsername" required="" value="admin">
                <label>Tài khoản</label>
            </div>
            <div class="user-box">
                <input type="password" name="txtPassword" required="" value="123456789">
                <label>Mật khẩu</label>
            </div>
            <a onclick="document.forms['login'].submit();">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                Đăng nhập
            </a>
        </form>
    </div>

</body>