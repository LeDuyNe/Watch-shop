<?php
//  Connect dtb
include('../config.php');
if (!isset($_SESSION['username'])) {
    header('location: ../login_submit.php');
}

// Hàm tự sinh ra chuỗi ngẫu nhiên
function generateRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

// Đặt các giá trị 
$alert_success = "";
$TenHH = $Gia = $SoLuongHang = $MaLoaiHang = $GhiChu = "";
$TenHHErr = $GiaErr = $SoLuongHangErr = $MaLoaiHangErr = $GhiChuErr = $anhErr =  "";

// Kiểm tra form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $MSHH = generateRandomString(5);
    $TenHH = $_POST["txtTenHH"];
    $Gia = $_POST["txtGia"];
    $SoLuongHang = $_POST["txtSoLuongHang"];
    $MaLoaiHang = $_POST["txtMaLoaiHang"];
    $GhiChu = $_POST["txtGhiChu"];
    $flag = 1;

    // Trích xuất dữ liệu tên hàng hóa
    $sql_TenHH = "select * from hanghoa where TenHH='$TenHH'";
    $kt_TenHH = mysqli_query($conn, $sql_TenHH);
    
    // Kiểm tra Tên Hàng Hóa
    if (empty($TenHH)) {
        $TenHHErr = "Tên hàng hóa không được để trống";
        $flag = 0;
    } else {
        if (mysqli_num_rows($kt_TenHH)  > 0) {
            $TenHHErr = "Tên hàng hóa đã tồn tại";
            $flag = 0;
        } else {
            $flag = 1 & $flag;
            $TenHHErr = "";
        }
    }

    // Kiểm tra Giá
    if (empty($Gia)) {
        $GiaErr = "Giá tiền không được để trống";
        $flag = 0;
    } else {
        if ($Gia <= 0) {
            $GiaErr = "Giá tiền phải lớn hơn không";
            $flag = 0;
        } else {
            $flag = 1 & $flag;
            $GiaErr = "";
        }
    }

    //  Số lượng hàng
    if (empty($SoLuongHang)) {
        $SoLuongHangErr = "Số lượng hàng không được để trống";
        $flag = 0;
    } else {
        if ($SoLuongHang <= 0) {
            $SoLuongHangErr = "Số lượng hàng phải lớn hơn không";
            $flag = 0;
        } else {
            $flag = 1 & $flag;
            $SoLuongHangErr = "";
        }
    }

    //  Kiểm tra Ghi chú
    if (empty($GhiChu)) {
        $GhiChuErr = "Ghi chú  không được để trống";
        $flag = 0;
    } else {
        $flag = 1 & $flag;
        $GhiChuErr = "";
    }

    // Kiểm tra ảnh
    $target_dir = "upload/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $file_type_allow = array('jpg', 'png');

    if ($_FILES["fileToUpload"]["error"] == 4 || $_FILES["fileToUpload"]["error"] != 0) {
        $anhErr =  "File không được để trống";
        $flag = 0;
    } else if (file_exists($target_file)) {
        $anhErr =  "Ảnh đã tồn tại";
        $flag = 0;
    } else if ($_FILES["fileToUpload"]["size"] > 2097152) {
        $anhErr =  "Dung lượng tối đa là 2KB";
        $flag = 0;
    } else if (!in_array($file_type,  $file_type_allow)) {
        $anhErr =  "Bắt buộc: jpg hoặc png";
        $flag = 0;
    } else {
        $flag = 1 & $flag;
        $anhErr = "";
    }
    //  Ktra file và up vào hệ thống
    if ($flag == 1) {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $flag = 1 & $flag;
        } else {
            $flag = 0;
            $anhErr =  "Quá trình upload file xảy ra vấn đề";
        }
    }
    

    if ($flag == 1 & $flag) {
        $addproduct = "INSERT INTO hanghoa(
                    MSHH,
                    TenHH,
                    Gia,
                    SoLuongHang,
                    MaLoaiHang,
                    GhiChu,
                    anh
                    ) VALUES (
                        '$MSHH',
                        '$TenHH',
                        '$Gia',
                        '$SoLuongHang',
                        '$MaLoaiHang',
                        '$GhiChu',
                        '$target_file'
                    )";

        // thực thi câu $sql với biến conn lấy từ file connection.php
        mysqli_query($conn, $addproduct);
        $alert_success =  "Đã thêm thành công";
    }
}


?>
<div class="gird__column-10">
    <div class="home-filter">
        <span class="home-filter__label">Hiển thị theo</span>
        <button class="home-filter__btn btn">Thêm Sản phẩm</button>
    </div>
    <div class="user-info">
        <div class="product-box">
            <h2 style="margin-bottom: 30px;">Thêm sản phẩm</h2>
            <form name="product" class='product' action="/web_banhang/admin/index.php?page_layout=themhanghoa" method="POST" enctype="multipart/form-data">
                <div class="product-box">
                    <label>Tên hàng hóa</label>
                    <span class="product-error"><?php echo $TenHHErr; ?></span>
                    <input type="text" name="txtTenHH" required="">
                </div>

                <div class="product-box">
                    <label>Giá</label>
                    <span class="product-error"><?php echo $GiaErr; ?></span>
                    <input type="text" name="txtGia" required="">
                </div>

                <div class="product-box">
                    <label>Số Lượng Hàng</label>
                    <span class="product-error"><?php echo $SoLuongHangErr; ?></span>
                    <input type="text" name="txtSoLuongHang" required="">
                </div>

                <div class="product-box">
                    <label>Mã Loại Hàng</label>
                    <span class="product-error"><?php echo $MaLoaiHangErr; ?></span>
                    <select name="txtMaLoaiHang" id="" style="font-size:18px">
                        <?php
                        $sql_Name1 = "SELECT * FROM `loaihanghoa` WHERE 1";
                        $sql_query1 = mysqli_query($conn, $sql_Name1);
                        while ($rows = mysqli_fetch_array($sql_query1)) {
                            ?>
                            <option value="<?php echo $rows['MaLoaiHang'] ?>"> <?php echo $rows['TenLoaiHang'] ?></option>
                        <?php
                        }
                        ?>
                </select>
                </div>
               

                <div class="product-box">
                    <label>Ghi chú</label>
                    <span class="product-error"><?php echo $GhiChuErr; ?></span>
                    <input type="text" name="txtGhiChu" required="">
                </div>

                <div class="product-box">
                    <label>Ảnh</label>
                    <span class="product-error"><?php echo $anhErr; ?></span>
                    <input type="file" name="fileToUpload" required="">
                </div>               

                <a onclick="document.forms['product'].submit()">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    Thêm
                </a>
                <span class="product-susscess"><?php echo $alert_success; ?></span>
            </form>

        </div>
    </div>
</div>



