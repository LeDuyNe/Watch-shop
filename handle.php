<?php
//  Connect dtb
include('../config.php');
if (!isset($_SESSION['username'])) {
    header('location: ../login_submit.php');
}
?>
<?php
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $datetime_recieve = date("Y-m-d");
    $trangthai = isset($_GET['trangthai']) ? $_GET['trangthai'] : null;
    $sodondathang = isset($_GET['sodondathang']) ? $_GET['sodondathang'] : null;
    $MSHH = isset($_GET['MSHH']) ? $_GET['MSHH'] : null;
    $sql = "SELECT SoLuongHang FROM hanghoa WHERE MSHH = '$MSHH'";  
    $soluonghethong =  mysqli_fetch_row(mysqli_query($conn, $sql))[0];
    $soluongmua = isset($_GET['soluongmua']) ? $_GET['soluongmua'] : null;
    if (isset($trangthai) and isset($sodondathang)) {
        if($trangthai == 1){
            mysqli_query($conn, "UPDATE `dathang` SET `TrangThai`='$trangthai', `NgayGH`='$datetime_recieve' WHERE SoDonDH='$sodondathang'");
            echo "<script> 
                 alert('Cập nhật thành công');
                 window.location.href='index.php?page_layout=bill';
             </script>";
        }else if ($trangthai == 3 ){
            $soluongconlai = 0;
            echo $soluongmua;
            $soluongconlai = $soluonghethong +  $soluongmua;
            echo $soluongconlai;
            mysqli_query($conn, "UPDATE `hanghoa` SET `SoLuongHang`= '$soluongconlai' WHERE MSHH='$MSHH'");
            mysqli_query($conn, "UPDATE `dathang` SET `TrangThai`='$trangthai' WHERE SoDonDH='$sodondathang'");
            mysqli_query($conn, "UPDATE `dathang` SET `NgayGH`='0000-00-00' WHERE SoDonDH='$sodondathang'");
            echo "<script> 
                 alert('Cập nhật thành công');
                 window.location.href='index.php?page_layout=bill';
             </script>";
        }else{
            echo "<script> 
                 alert('Cập nhật thất bại');
                 window.location.href='index.php?page_layout=bill';
             </script>";
        }
        
    }
?>
