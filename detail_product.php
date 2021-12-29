<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Css favi -->
    <link rel="icon" href="assets/img/favi.png" type="image/x-icon" />
    <!-- Reset CSS -->
    <link rel="" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <!-- GG-Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap">
    <!-- Icon  -->
    <link rel="stylesheet" href="assets/font/fontawesome-free-5.15.2/css/all.min.css">
    <link rel="stylesheet" href="assets/css/base.css?v=<?php echo time() ?>">
    <link rel="stylesheet" href="assets/css/main.css?v=<?php echo time() ?>">

    <title>Watch Shop</title>
</head>
<?php
ob_start();
session_start();
include_once('./config.php');

?>

<body>
    <div class="app">
        <div class="header">
            <div class="grid">
                <nav class="header__navbar">
                    <ul class="header__navbar-list">
                        <li class="header__navbar-item header__navbar-item--has-qr header__navbar-item--separate">
                            ỨNG DỤNG DUYLE'WATCH
                            <div class="header__qr">
                                <img src="assets/img/qr.PNG" alt="" class="header__qr-img">
                                <div class="header__qr-apps">
                                    <a href="" class="header__qr-apps-link">
                                        <img src="assets/img/appstore.png" alt="" class="header__qr-dowloand-img">
                                    </a>

                                    <a href="" class="header__qr-apps-link">
                                        <img src="assets/img/ggplay.png" alt="" class="header__qr-dowloand-img">
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li class="header__navbar-item">
                            KẾT NỐI
                            <a href="" class="header__navbar-icon-link"> <i class="fab fa-facebook"></i></a>
                            <a href="" class="header__navbar-icon-link"> <i class="fab fa-instagram"></i></a>
                        </li>
                    </ul>



                    <ul class="header__navbar-list">
                        <li class="header__navbar-item ">QUẢN LÝ
                            <ul class="header__subnav">
                                <li><a href="login_submit.php" target="_blank">ĐĂNG NHẬP</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>

                <div class="header-with-search">
                    <div class="header__logo">
                        <a href="index.php" class="header__logo-link">
                            <img src="assets/img/watch.png" alt="" class="header__logo-img">
                        </a>
                    </div>


                    <div class="header__search">
                        <div class="header__search-input-wrap">
                            <input type="text" class="header__search-input" placeholder="Nhập để tìm kiếm sản phẩm">
                            <div class="header__search-history">
                                <h3 class="header__search-history-heading">Lịch sử tìm kiếm</h3>
                                <ul class="header__search-history-list">
                                    <li class="header__search-history-item">
                                        <a href="">Đồng hồ casio</a>
                                    </li>
                                    <li class="header__search-history-item">
                                        <a href="">Đồng hồ orient</a>
                                    </li>
                                </ul>
                            </div>
                        </div>


                        <button type="button" class="header__search-btn">
                            <i class="header__search-btn-icon fas fa-search"></i>
                        </button>
                    </div>

                    <!-- Cart layout -->
                    <div class="header__cart">
                        <div class="header__cart-wrap">
                            <i class="header_cart-icon fas fa-shopping-cart" style="color: #6C757D;"></i>
                            <span class="header__cart-notice"><?php if (isset($_SESSION['giohang'])) {
                                                                    echo count($_SESSION['giohang']);
                                                                } else {
                                                                    echo 0;
                                                                }
                                                                ?>
                            </span>

                            <div class="header__cart-list">
                                <img src="assets/img/no_cart.png" class="header__cart-no-cart-img" alt="">

                                <h4 class="header__cart-heading">Giỏ hàng của bạn</h4>
                                <!-- cart item -->
                                <ul class="header__cart-list-item">
                                    <li class="header__cart-item">
                                        <!-- <img src="assets/img/item1_cart.png" alt="" class="header__cart-img"> -->
                                        <div class="header__cart-info">
                                            <div class="header__cart-item-head">
                                                <!-- <h5 class="header__cart-item-name">Đồng hồ Xiaomi Mi Watch Lite</h5> -->
                                                <div class="header__cart-item-price-wrap">
                                                    <!-- <span class="header__cart-item-price"></span> -->
                                                    <!-- <span class="header__cart-item-multiply">x</span> -->
                                                    <p>Bạn đang có <span class="header__cart-item-qnt"><?php if (isset($_SESSION['giohang'])) {
                                                                                                            echo count($_SESSION['giohang']);
                                                                                                        } else {
                                                                                                            echo 0;
                                                                                                        }   ?></span> sản phẩm</p>
                                                </div>
                                            </div>

                                            <!-- <div class="header__cart-item-body">
                                                <span class="header__cart-item-description">Phân loại: Bạc</span>
                                                <span class="header__cart-item-remove">Xóa</span>
                                            </div> -->
                                        </div>
                                    </li>
                                </ul>
                                <a href="" class="header__cart-view-cart btn btn--primary>">Xem giỏ hàng </a>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="app__container">
        <div class="grid">
            <div class="grid__row">
                <div class="gird__column-5">
                    <div class="detail__product-img">
                        <?php
                        $MSHH = $_REQUEST['MSHH'];
                        $query = "SELECT * FROM hanghoa WHERE MSHH = '$MSHH'";
                        $result = mysqli_query($conn, $query);
                        // mysqli_close($conn);
                        ?>

                        <?php
                        while ($row = mysqli_fetch_array($result)) {
                            ?>
                            <img src="<?php echo './admin/' . $row['anh'] ?>" class="detail__product-img--item">
                        <?php } ?>
                    </div>


                </div>

                <div class="gird__column-7">
                    <div class="detail__product-content">
                        <?php
                        $MSHH = $_REQUEST['MSHH'];
                        $query = "SELECT * FROM hanghoa WHERE MSHH = '$MSHH'";
                        $result = mysqli_query($conn, $query);
                        mysqli_close($conn);
                        ?>

                        <?php
                        while ($row = mysqli_fetch_array($result)) {
                            ?>
                            <h2><?php echo $row['TenHH']; ?></h2>
                            <h3>THÔNG TIN SẢN PHẨM</h3>
                            
                            <p> <b>Giá sản phẩm: </b><span class="header__cart-item-price"><?php echo number_format($row['Gia'], 0, ',', '.') ?> đồng</span> 
                            <p> <b> Số lượng còn: </b> <?php echo $row['SoLuongHang']; ?> </p>
                            <p> <b> Mô tả sản phẩm: </b> <?php echo $row['GhiChu']; ?> </p>
                            <div class="detail__product-control">
                                <a href="./add_cart.php?MSHH=<?php echo $row['MSHH'] ?>"><button type="button" class="btn btn--primary">Đặt mua</button></a>
                            </div>

                            <?php } ?>
                            </p>



                    </div>
                </div>
            </div>
        </div>

        <div class="footer">
            <div class="grid">
                <div class="grid__row">
                    <div class="gird__column-2-4">
                        <h3 class="footer_heading">Chăm sóc khách hàng</h3>
                        <ul class="footer__list">
                            <li class="footer__item">
                                <a href="" class="footer__item-link">Trung Tâm Trợ Giúp</a>
                            </li>
                            <li class="footer__item"> <a href="" class="footer__item-link">DuyLe'Watch Mail</a></li>
                            <li class="footer__item"> <a href="" class="footer__item-link">Hướng Dẫn Mua Hàng</a></li>
                        </ul>
                    </div>

                    <div class="gird__column-2-4">
                        <h3 class="footer_heading">Giới thiệu</h3>
                        <ul class="footer__list">
                            <li class="footer__item"><a href="" class="footer__item-link">Giới Thiệu</a></li>
                            <li class="footer__item"><a href="" class="footer__item-link">Tuyển Dụng</a></li>
                            <li class="footer__item"><a href="" class="footer__item-link">Điều Khoản</a></li>
                        </ul>
                    </div>
                    <div class="gird__column-2-4">
                        <h3 class="footer_heading">Danh mục</h3>
                        <ul class="footer__list">
                            <li class="footer__item"><a href="" class="footer__item-link">Đồng Hồ Casio</a></li>
                            <li class="footer__item"><a href="" class="footer__item-link">Đồng Hồ Orient</a></li>
                            <li class="footer__item"><a href="" class="footer__item-link">Đồng Hồ Seiko</a></li>
                        </ul>
                    </div>

                    <div class="gird__column-2-4">
                        <h3 class="footer_heading">Theo Dõi</h3>
                        <ul class="footer__list">
                            <li class="footer__item">
                                <a href="" class="footer__item-link">
                                    <i class="fab fa-facebook footer__item-icon"></i>
                                    FaceBook
                                </a>
                            </li>
                            <li class="footer__item">
                                <a href="" class="footer__item-link">
                                    <i class="fab fa-instagram footer__item-icon"></i>
                                    Instagram
                                </a>
                            </li>

                        </ul>
                    </div>

                    <div class="gird__column-2-4">
                        <h3 class="footer_heading">Vào cửa hàng trên ứng dụng</h3>
                        <div class="footer__download">
                            <img src="assets/img/qr.PNG" alt="Download Qr" class="footer__download-qr">
                            <div class="footer__download-apps">
                                <a href="" class="footer__download-apps-link">
                                    <img src="assets/img/ggplay.png" alt="GG Play" class="footer__dowload-app-img">
                                </a>

                                <a href="" class="footer__download-apps-link">
                                    <img src="assets/img/appstore.png" alt="App Store" class="footer__dowload-app-img">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer__bottom">
                <div class="grid">
                    <p class="footer__text">© 2021 - Bản quyền thuộc về Công ty DuyLe'Watch</p>
                </div>
            </div>

        </div>
</body>

</html>