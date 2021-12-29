<?php
session_start();
//tiến hành kiểm tra là người dùng đã đăng nhập hay chưa
//nếu chưa, chuyển hướng người dùng ra lại trang đăng nhập
if (!isset($_SESSION['username'])) {
    header('location: ../login_submit.php');
}

?>
<?php
// File kết nối với database
include('../config.php');

//  utf-8 hiển thị tiếng Việt
header('Content-Type: text/html; charset=UTF-8');
// Đặt các giá trị
$username = $password = "";
$userErr = $alert_success =  "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && !array_key_exists("page_layout", $_GET)) {
    $username = $_POST["txtUsername"];
    $password = $_POST["txtPassword"];
    //làm sạch thông tin, xóa bỏ các tag html, ký tự đặc biệt 
    //mà người dùng cố tình thêm vào để tấn công theo phương thức sql injection
    $username = strip_tags($username);
    $username = addslashes($username);
    $password = strip_tags($password);
    $password = addslashes($password);

    // $password = md5($password);
    if ($username == "" || $password == "") {
        $_SESSION['userError'] = 'Tài khoản hoặc mật khẩu không được để trống!';
    } else {
        if ($username !== 'admin' || $password !== '123456789') {
            $_SESSION['userError'] = 'Tên đăng nhập hoặc mật khẩu không đúng !';
        } else {
            //tiến hành lưu tên đăng nhập vào session để tiện xử lý sau này
            $_SESSION['username'] = $username;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang quản lý</title>
    <!-- Css favi -->
    <link rel="icon" href="assets/img/favi.png" type="image/x-icon" />
    <!-- Reset CSS -->
    <link rel="" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <!-- GG-Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap">
    <!-- Icon  -->
    <link rel="stylesheet" href="assets/font/fontawesome-free-5.15.2/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/base.css?v=<?php echo time() ?>">
    <link rel="stylesheet" href="../assets/css/main.css?v=<?php echo time() ?>">
    <link rel="stylesheet" href="../assets/css/table.css?v=<?php echo time() ?>">
    <link rel="stylesheet" href="../assets/css/product.css?v=<?php echo time() ?>">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href=""> -->

    <title>Trang chủ quản lý</title>
</head>

<body>
    <div class="app">
        <div class="header">
            <div class="grid">
                <nav class="header__navbar">
                    <ul class="header__navbar-list">
                        <li class="header__navbar-item header__navbar-item--has-qr">
                            DUYLE'WATCH ADMIN
                        </li>
                        <div class="header-with-search">
                            <div class="header__logo">
                                <a href="index.php" class="header__logo-link">
                                    <img src="../assets/img/watch.png" alt="" class="header__logo-img">
                                </a>
                            </div>
                        </div>
                    </ul>

                    <ul class="header__navbar-list">
                        <!-- <li class="header__navbar-item ">TÀI KHOẢN
                                <ul class="header__subnav">
                                    <li><a href="login_submit.php">ĐĂNG KÝ</a></li>
                                </ul>
                            </li> -->

                        <li class="header__navbar-item header__navbar-user">
                            <img src="../assets/img/avarta.jpg" alt="" class="header__navbar-user-img">
                            <span class="header__navbar-user-name"><?php echo  $_SESSION['username']; ?></span>
                            <ul class="header__navbar-user-menu">
                                <li class="header__navbar-user-item"><a href="#">Thông tin</a></li>
                                <li class="header__navbar-user-item header__navbar-user-item--seperate"><a href="./logout.php">
                                        Đăng xuất</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>


            </div>
        </div>
        <div class="app__container">
            <div class="grid">
                <div class="grid__row app__content">
                    <div class="gird__column-1">
                        <nav class="category">
                            <h3 class="category__heading" style="padding: 0;"><a href="#" class="category-item__link">Trang chủ</a></h3>
                            <ul class="category-list">

                                <li class="category-item category-item--active">
                                    <a href="index.php?page_layout=bill" class="category-item__link">Đơn Hàng</a>
                                </li>

                                <li class="category-item">
                                    <a href="index.php?page_layout=hanghoa" class="category-item__link">Sản Phẩm</a>
                                </li>
                            </ul>
                        </nav>
                    </div>

                    <?php
                    // trang chủ 
                    if (array_key_exists('page_layout', $_GET)) {
                        switch ($_GET["page_layout"]) {
                            case 'xuly':
                                include_once('handle.php');
                                break;
                            case 'xoanhanvien':
                                include_once('delete_members.php');
                                break;
                            case 'hanghoa':
                                include_once('product.php');
                                break;
                            case 'themhanghoa':
                                include_once('add_product.php');
                                break;
                            case 'suahanghoa':
                                include_once('update_product.php');
                                break;
                            case 'bill':
                                include_once('bill.php');
                                break;
                        }
                    } else {
                        include_once './introduce.html';
                    }
                    ?>



                </div>
            </div>
        </div>
        <div class="footer">
            <div class="grid">
                <div class="footer__bottom">
                    <div class="grid">
                        <p class="footer__text">© 2021 - Bản quyền thuộc về Công ty DuyLe'Watch</p>
                    </div>
                </div>
            </div>
        </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
<script src="assets/script/vendor/slick.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
</html>