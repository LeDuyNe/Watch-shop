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

                            <!-- No cart: header__cart-list--no-cart -->
                            <div class="header__cart-list">
                                <?php if (isset($_SESSION['giohang'])) {

                                    ?>
                                    <!-- cart item -->
                                    <ul class="header__cart-list-item">
                                        <?php foreach ($_SESSION['giohang'] as $key => $value) {
                                                $sql = "SELECT * FROM hanghoa WHERE MSHH = '$key'";
                                                $query = mysqli_query($conn, $sql);
                                                $row = mysqli_fetch_array($query);
                                                ?>

                                            <li class="header__cart-item">
                                                <img src="<?php $anh = $row['anh'];
                                                                    echo "./admin/$anh" ?>" alt="" class="header__cart-img">
                                                <div class="header__cart-info">
                                                    <div class="header__cart-item-head">
                                                        <h5 class="header__cart-item-name"><?php echo $row['TenHH'] ?></h5>
                                                        <div class="header__cart-item-price-wrap">
                                                            <span class="header__cart-item-price"><?php echo number_format($row['Gia'], 0, ',', '.') ?>vnd</span>
                                                            <span class="header__cart-item-multiply">x</span>
                                                            <span class="header__cart-item-qnt"><?php echo  $_SESSION['giohang'][$row['MSHH']]; ?></span>

                                                        </div>
                                                    </div>
                                                    <div class="header__cart-item-body">
                                                        <span class="header__cart-item-description">Phân loại: <?php echo $row['MaLoaiHang'] ?></span>
                                                        <!-- <span class="header__cart-item-remove">Xóa</span> -->
                                                    </div>
                                            </li>
                                        <?php } ?>

                                    </ul>

                                <?php
                                } else {
                                    echo "<img src='./assets/img/no_cart.png' class='header__cart-no-cart-img' alt=''>";
                                }
                                ?>
                                <a href="./cart.php" class="header__cart-view-cart btn btn--primary>">Xem giỏ hàng </a>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="app__container">
        <div class="grid">
            <div class="grid__row app__content">
                <div class="gird__column-2">
                    <nav class="category">
                        <h3 class="category__heading">Danh mục</h3>

                        <ul class="category-list">
                            <li class="category-item category-item--active">
                                <a href="/web_banhang" class="category-item__link">Tất cả</a>
                            </li>

                            <?php
                            $sql = "SELECT * FROM loaihanghoa";
                            $query = mysqli_query($conn, $sql);
                            while ($rows = mysqli_fetch_array($query)) {
                                ?>
                                <li class="category-item category-item--active">

                                    <a href="/web_banhang?category=<?php echo $rows['MaLoaiHang'] ?>" class="category-item__link">Đồng hồ <?php echo $rows['TenLoaiHang'] ?></a>
                                </li>
                            <?php } ?>
                        </ul>

                    </nav>
                </div>

                <div class="gird__column-10">
                    <div class="home-filter">
                        <span class="home-filter__label">Sắp xếp theo</span>
                        <button class="home-filter__btn btn">Phổ biến</button>
                        <button class="home-filter__btn btn btn--primary">Mới nhất</button>
                        <button class="home-filter__btn btn">Bán chạy</button>

                        <div class="select-input">
                            <span class="select-input__label">Giá</span>
                            <i class="select-input__icon fas fa-angle-down"></i>

                            <!-- List options -->
                            <ul class="select-input__list">
                                <li class="select-input__item">
                                    <a href="" class="select-input__link">Giá: Thấp đến cao</a>
                                </li>

                                <li class="select-input__item">
                                    <a href="" class="select-input__link">Giá: Cao đến thấp</a>
                                </li>

                            </ul>
                        </div>

                        <div class="home-filter__page">
                            <span class="home-filter__page-num">
                                <span class="home-filter__page-current">1</span>/3
                            </span>

                            <div class="home-filter__page-control">
                                <a href="" class="home-filter__page-btn home-filter__page-btn--disable">
                                    <i class="home-filter__page-icon fas fa-angle-left"></i>
                                </a>

                                <a href="" class="home-filter__page-btn">
                                    <i class="home-filter__page-icon fas fa-angle-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="home-product">
                        <!-- Grid -> Row -> Column -->
                        <div class="grid__row">
                            <?php
                            $query_str = "SELECT * FROM hanghoa";
                            if (array_key_exists('category', $_GET))
                                $query_str = $query_str . " WHERE MaLoaiHang='" . $_GET['category'] . "'";

                            $result = mysqli_query($conn, $query_str);
                            mysqli_close($conn);
                            ?>

                            <?php while ($row = mysqli_fetch_array($result)) { ?>
                                <?php if ($row['SoLuongHang'] > 0) { ?>
                                    <div class="gird__column-2-4 ">
                                        <a class="home-product-item" href="/web_banhang/detail_product.php?MSHH=<?php echo $row['MSHH'] ?>">

                                            <img src="<?php echo './admin/' . $row['anh'] ?>" class="home-product-item__img">
                                            <h4 class="home-product-item__name"><?php echo $row['TenHH'] ?></h4>

                                            <div class="home-product-item__price">
                                                <span class="home-product-item__price-current"><?php echo number_format($row['Gia'], 0, ',', '.') ?> đồng</span>
                                            </div>

                                            <div class="home-product-item__action">
                                                <span class="home-product-item__like home-product-item__like--like">
                                                    <i class="home-product-item__like-icon-empty far fa-heart"></i>
                                                    <i class="home-product-item__like-icon-fill fas fa-heart"></i>
                                                </span>

                                                <span class="home-product-item__rating">
                                                    <i class="home-product-item__start--gold fas fa-star"></i>
                                                    <i class="home-product-item__start--gold fas fa-star"></i>
                                                    <i class="home-product-item__start--gold fas fa-star"></i>
                                                    <i class="home-product-item__start--gold fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                </span>

                                                <span class="home-product-item__sold">Còn <?php echo $row['SoLuongHang'] ?></span>
                                            </div>

                                            <div class="home-product-item__favourite">
                                                <i class="fas fa-check"></i>
                                                <span>Yêu thích</span>
                                            </div>

                                            <div class="home-product-item__sale-off">
                                                <span class="home-product-item__sale-off-percent">10%</span>
                                                <span class="home-product-item__sale-off-label">GIẢM</span>
                                            </div>
                                        </a>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        </div>

                        <ul class="pagination home-product__pagination">
                            <li class="pagination-item">
                                <a href="" class="pagination-item__link">
                                    <i class="pagination-item__icon fas fa-angle-left"></i>
                                </a>
                            </li>

                            <li class="pagination-item pagination-item--active">
                                <a href="" class="pagination-item__link">1</a>
                            </li>

                            <li class="pagination-item">
                                <a href="" class="pagination-item__link">2</a>
                            </li>

                            <li class="pagination-item">
                                <a href="" class="pagination-item__link">3</a>
                            </li>

                            <li class="pagination-item">
                                <a href="" class="pagination-item__link">4</a>
                            </li>

                            <li class="pagination-item">
                                <a href="" class="pagination-item__link">
                                    <i class="pagination-item__icon fas fa-angle-right">

                                    </i>
                                </a>
                            </li>
                        </ul>
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
        <p>Bạn đang có <span class="header__cart-item-qnt"><?php if (isset($_SESSION['giohang'])) {
                                                                echo count($_SESSION['giohang']);
                                                            } else {
                                                                echo 0;
                                                            }   ?></span> sản phẩm</p>
</body>

</html>