
<?php
session_start();
include_once('./config.php');
?>
<?php 
    // Hàm tự sinh ra chuỗi ngẫu nhiên
    function generateRandomString($length)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $MSKH = generateRandomString(5);   
        $MaDC = generateRandomString(5);
        $datetime_send = date("Y-m-d h:i:s");
        $ten = $_POST['txtUsername'];
        $congty = $_POST['txtCompany'];
        $email = $_POST['txtEmail'];
        $sdt = $_POST['numPhone'];
        $diachi = $_POST['txtAddress'];
        $SL = 0;

        if (isset($ten) && isset($email) && isset($sdt) && isset($diachi)) {
            if (isset($_SESSION['giohang'])) {
                $arrMSHH = array();
                foreach ($_SESSION['giohang'] as $MSHH => $so_luong) {
                    $arrMSHH[] = $MSHH;
                }
                $strMSHH = implode("', '", $arrMSHH);
                $sql = "SELECT * FROM hanghoa WHERE MSHH IN ('$strMSHH')";
                $query = mysqli_query($conn, $sql);
                while ($rows = mysqli_fetch_array($query)) {
                    $tongtien = $rows['Gia'] * $_SESSION['giohang'][$rows['MSHH']];
                    $SDDH = generateRandomString(5);
                    $MSHH = $rows['MSHH'];
                    $soluong = $_SESSION['giohang'][$rows['MSHH']];
                    $soluonghethonghienco = $rows['SoLuongHang'];
                    $soluongconlai =   $soluonghethonghienco -  $soluong;
                    $dathang = "INSERT INTO dathang(
                        SoDonDH,    
                        MSKH,
                        NgayDH
                    ) VALUES (
                            '$SDDH',
                            '$MSKH',
                            '$datetime_send'                          
                    )";

                    $chitietdathang = "INSERT INTO chitietdathang(
                        SoDonDH,    
                        MSHH,
                        SoLuong,
                        GiaDatHang
                    ) VALUES (
                        '$SDDH',
                        '$MSHH',
                        '$soluong',
                        '$tongtien'
                    )";  
                    $soluonghanghoa = "UPDATE `hanghoa` SET `SoLuongHang`= '$soluongconlai' WHERE MSHH='$MSHH'";
                    
                    mysqli_query($conn, $dathang);
                    mysqli_query($conn, $chitietdathang);
                    mysqli_query($conn, $soluonghanghoa);
                }
            }
        }

        $diachikh = "INSERT INTO diachikh(
            MaDC,    
            DiaChi,
            MSKH
        ) VALUES (
            '$MaDC',
            '$diachi',
            '$MSKH'
        )";

        $khachhang = "INSERT INTO khachhang(
            MSKH,    
            HotenKH,
            TenCongTy,
            DiaChi,
            SoDienThoai,
            Email
        ) VALUES (
            '$MSKH',
            '$ten',
            '$congty', 
            '$diachi',
            '$sdt',
            '$email'                          
        )";

        mysqli_query($conn, $khachhang);
        mysqli_query($conn, $diachikh);
        unset($_SESSION['giohang']);
        header('Location: /web_banhang/delete_cart.php?MSHH=1');
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
    <!-- GG-Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap">
    <!-- Boostrap 5 -->
    <link rel="stylesheet" href="assets/css/base.css?v=<?php echo time() ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <!-- Icon  -->
    <link rel="stylesheet" href="assets/font/fontawesome-free-5.15.2/css/all.min.css">

    <link rel="stylesheet" href="assets/css/main.css?v=<?php echo time() ?>">
    <link rel="stylesheet" href="assets/css/info_customer.css?v=<?php echo time() ?>">
    <title>Watch Shop</title>
</head>


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
                            <span class="header__cart-notice">
                                <?php if (isset($_SESSION['giohang'])) {
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
                                                        <span class="header__cart-item-remove">Xóa</span>
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

    
    <div class="app__container" style="background-color: white;">
        <div class="grid">
            <div class="grid__row">
                <div class="cart-containt">
                    <h2>Xác nhận hóa đơn</h2>
                    <?php
                    if (isset($_SESSION['giohang'])) {
                        $arrMSHH = array();
                        foreach ($_SESSION['giohang'] as $MSHH => $so_luong) {
                            $arrMSHH[] = '"' . $MSHH . '"';
                        }

                        $strMSHH = implode(',', $arrMSHH);
                        $sql = "SELECT * FROM hanghoa WHERE MSHH IN ($strMSHH) ORDER BY  MSHH DESC";
                        $query = mysqli_query($conn, $sql);
                        ?>

                        <form id="giohang" method="POST">
                            <table class="table table-succes" id="giohang">
                                <thead>
                                    <tr>
                                        <th scope="col" style="font-size: 1.4rem;">Ảnh sản phẩm</th>
                                        <th scope="col" style="font-size: 1.4rem;">Tên sản phẩm</th>
                                        <th scope="col" style="font-size: 1.4rem;  text-align: center;">Giá</th>
                                        <th scope="col" style="font-size: 1.4rem;  text-align: center;">Số lượng</th>
                                        <th scope="col" style="font-size: 1.4rem;  text-align: center;">Thành Tiền</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <!-- Product item -->
                                    <?php
                                        $tonggiatri = 0;
                                        while ($row = mysqli_fetch_array($query)) {
                                            $tonggiatien = $row['Gia'] * $_SESSION['giohang'][$row['MSHH']];
                                            ?>
                                        <tr>
                                            <td style="font-size: 1.4rem; line-height: 100%"> <img src="<?php echo './admin/' . $row['anh'] ?>" alt="" style="width: 100px; height: 100px;"></td>

                                            <td style="font-size: 1.4rem; line-height: 100%; line-height: 91px"><?php echo $row['TenHH']; ?> </td>

                                            <td style="font-size: 1.4rem; text-align: center; line-height: 91px"><?php echo number_format($row['Gia'], 0, ',', '.') ?></td>

                                            <td style="font-size: 1.4rem; text-align: center;  line-height: 91px "><?php echo $_SESSION['giohang'][$row['MSHH']]; ?></td>

                                            <td style="font-size: 1.4rem; text-align: center;  line-height: 91px;"><?php echo number_format($tonggiatien, 0, ',', '.') ?></td>
                                        </tr>
                                        <?php
                                                $tonggiatri += $tonggiatien;
                                                ?>
                                    <?php
                                        } 
                                        ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td style="font-size: 1.6rem;line-height: 91px; font-weight: 600;"> Tổng giá trị hóa đơn: </td>
                                        <td></td>
                                        <td></td>
                                        <td style="font-size: 1.4rem; font-size: 400;"><span style="font-size: 1.6rem; color: red; font-weight: bold;"> <?php echo  number_format($tonggiatri, 0, ',', '.') ?></span></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </form>
                    <?php
                    } else {
                        echo '<script>alert("Không có sản phẩm trong giỏ hàng của bạn!")</script>';
                    }
                    ?>

                </div>
                <!-- Button trigger modal -->

                <div class="info_customer">
                    <div class="info-form">
                        <h2>Thông Tin khách Hàng</h2>
                        <script>
                            function formCheck() {
                                let send = document.getElementById('staticBackdrop').classList.contains("show");
                                document.getElementById('frmSubmitBtn').click();
                                return send;
                            }
                        </script>
                        <form id="orderForm" action="/web_banhang/buy_product.php" onsubmit="return formCheck();" method="POST">
                            <div class="mb-3">
                                <label for="exampleInputName" class="form-label">Tên khách hàng</label>
                                <input type="text" class="form-control" id="exampleInputName" aria-describedby="nameHelp" name="txtUsername" required="required">
                                <div id="nameHelp" class="form-text"></div>
                                <div id="nameHelp" class="form-text">Vui lòng ghi họ tên người nhận hàng</div>
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputCompany" class="form-label">Tên công ty</label>
                                <input type="text" class="form-control" id="exampleInputCompany" aria-describedby="companylHelp" name="txtCompany" required="required">
                                <div id="companyHelp" class="form-text"></div>
                                <div id="companyHelp" class="form-text">Vui lòng ghi công ty đang công tác</div>
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputEmail" class="form-label">Email</label>
                                <input type="text" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" name="txtEmail" required="required">
                                <div id="emailHelp" class="form-text">Vui lòng ghi chính xác email</div>
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputPhone" class="form-label">Số điện thoại</label>
                                <input type="text" class="form-control" id="exampleInputPhone" aria-describedby="phoneHelp" name="numPhone" required="required">
                                <div id="phoneHelp" class="form-text">Số điện thoại gồm 10 hoặc 11 chữ số</div>
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputAddress" class="form-label">Địa chỉ</label>
                                <input type="text" class="form-control" id="exampleInputAddress" aria-describedby="addressHelp" name="txtAddress" required="required">
                                <div id="adddressHelp" class="form-text">Vui lòng ghi chính xác địa chỉ</div>
                            </div>
                            <input type="submit" value="Xác nhận" class="btn btn-primary" style="color: #fff; background-color: #FF6B35; border-color: #FF6B35; justify-self:center; margin: 5px 0 20px 0;">
                            <button id="frmSubmitBtn" style="display: none;" type="submit" class="btn btn-primary" style="color: #fff; background-color: #FF6B35; border-color: #0d6efd; justify-self:center; margin: 5px 0 20px 0;" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Xác nhận</button>


                            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel" style="font-size: 2rem; text-align: center;">THÔNG BÁO</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p style="font-size: 1.4rem; color: green; ">Quý khách đã đặt hàng thành công !</b><br />
                                                * Sản phẩm sẽ được giao trong 72 tiếng đến địa chỉ trong phần thông tin khách hàng.
                                                </br>
                                                * Nhân viên sẽ liên hệ với quý khách qua điện thoại để xác nhận lại lần nữa.
                                                <b><br />Cảm ơn quý khách đã lựa chọn sản phẩm của DuyLe"Watch! </b>
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button onclick="document.getElementById('orderForm').submit()" type="button" class="btn btn-primary" style="color: black; font-size: 1.4rem; text-decoration: none; ">Đã rõ</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <!-- Button trigger modal -->

    <!-- Modal -->
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
    <!-- Boostrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
</body>

</html>