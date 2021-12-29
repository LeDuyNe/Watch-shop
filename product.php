<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap">
<head>
    <title>Quản lý sản phẩm</title>
</head>

<?php
//  Connect dtb
include('../config.php');
if (!isset($_SESSION['username'])) {
    header('location: ../login_submit.php');
} else {

}
$result = mysqli_query($conn, "SELECT *FROM hanghoa");
mysqli_close($conn);
?>


<div class="gird__column-11">
    <div class="home-filter">
        <span class="home-filter__label">Hiển thị theo</span>
        <button class="home-filter__btn btn" style="font-size: 1.5rem; font-weight: 500;">Sản phẩm</button>
    </div>
    <div class="user-info">
        <h1>Danh sách hàng hóa</h1>
        <a href="/web_banhang/admin/index.php?page_layout=themhanghoa" style="margin-bottom: 20px;" target="_blank">Thêm hàng hóa mới</a>
        <table id="user-listing" style="width: 100%;">
            <tr>
                <th scope="col" style="width: 8%;font-size:14px;">MSHH</th>
                <th scope="col" style="width: 20%;font-size:14px;">Tên Hàng Hóa</th>
                <th scope="col" style="width: 10%;font-size:14px;">Giá</th>
                <th scope="col" style="width: 8%;font-size:14px;">Số lượng</th>
                <th scope="col" style="width: 8%;font-size:14px;">Mã loại hàng</th>
                <th scope="col" style="width: 22%;font-size:14px;">Ghi Chú</th>
                <th scope="col" style="width: 8%;font-size:14px;">Ảnh</th>
                <th scope="col" style="width: 8%;font-size:14px;">Sửa</th>
                <th scope="col" style="width: 8%;font-size:14px;">Xóa</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_array($result)) {
                ?>
                <tr>
                    <td>
                        <?php echo $row['MSHH']; ?>
                    </td>
                    <td>
                        <?php echo $row['TenHH'] ?>
                    </td>
                    <td>
                        <?php echo $row['Gia'] ?>
                    </td>
                    <td>
                        <?php echo $row['SoLuongHang'] ?>
                    </td>
                    <td>
                        <?php echo $row['MaLoaiHang'] ?>
                    </td>
                    <td>
                        <?php echo $row['GhiChu'] ?>
                    </td>
                    <td> 
                        <img src="./<?php echo $row['anh'] ?>" alt="" class="admin-product-item__img">
                    </td>
                    <td><a href="/web_banhang/admin/index.php?page_layout=suahanghoa&MSHH=<?php echo $row['MSHH']?>&TenHH=<?php echo $row['TenHH'];?>
                    &Gia=<?php echo $row['Gia'];?>&SoLuongHang=<?php echo $row['SoLuongHang'];?>" target="_blank;">
                            <i class='bx bxs-edit'></i></a></td>
                    <td><a href="delete_product.php?MSHH=<?php echo $row['MSHH']; ?>" onClick="return confirm('Bạn có thực sự muốn xóa hay không ?');">
                            <i class='bx bx-trash-alt'></i></a></td>

                </tr>
            <?php } ?>
        </table>
    </div>
</div>


</body>

</html>