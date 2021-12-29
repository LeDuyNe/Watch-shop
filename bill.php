<?php
//  Connect dtb
include('../config.php');

if (!isset($_SESSION['username'])) {
    header('location: ../login_submit.php');
}
$sql = "SELECT a.* , b.* 
 FROM `chitietdathang` as a, `dathang` as b
 WHERE a.SoDonDH = b.SoDonDH
 GROUP BY a.SoDonDH ORDER BY b.NgayDH DESC";
$result = mysqli_query($conn, $sql );
?>
<div class="gird__column-11">
    <div class="home-filter">
        <span class="home-filter__label">Hiển thị theo</span>
        <button class="home-filter__btn btn" style="font-size: 1.5rem; font-weight: 500;" >Danh sách đơn hàng</button>
    </div>
    <div class="user-info">
        <h1>Danh sách đơn hàng</h1>
        <table class="table table-striped"">
            <thead>
                <th scope="col"  style=" width: 10%; font-size: 1.4rem;  text-align: center;">Số đơn</th>
                <th scope="col th scope="col" style="width: 10%; font-size: 1.4rem;  text-align: center;">Mã số hàng hóa</th>
                <th scope="col th scope="col" style=" width: 10%;font-size: 1.4rem;  text-align: center;">Số lượng</th>
                <th scope="col th scope="col" style="width: 15%;font-size: 1.4rem;  text-align: center;">Ngày đặt hàng</th>
                <th scope="col th scope="col" style="width: 15%;font-size: 1.4rem;  text-align: center;">Ngày giao hàng</th>
                <th scope="col th scope="col" style="width: 10%; font-size: 1.4rem;  text-align: center;">Họ tên KH</th>
                <th scope="col th scope="col" style="width: 10%; font-size: 1.4rem;  text-align: center;">Địa chỉ</th>
                <th scope="col th scope="col" style="width: 10%;font-size: 1.4rem;  text-align: center;">Tổng chi</th>
                <th scope="col th scope="col" style="width: 20%;font-size: 1.4rem;  text-align: center;">Tình trạng</th>
                </tr>
            </thead>
            <?php
            while ($row = mysqli_fetch_array($result)) {
                $MSKH = $row['MSKH'];
                $sql_khachhang =  "SELECT * FROM `khachhang` WHERE MSKH='$MSKH'";
                $query_khachhang = mysqli_query($conn, $sql_khachhang);
                $kh   = mysqli_fetch_array($query_khachhang);
                ?>
            <tbody>
                <tr>
                    <td style="font-size: 1.5rem; text-align: center; line-height: 80px; height: 60px;">
                        <?php echo $row['SoDonDH']; ?>
                    </td>

                    <td style="font-size: 1.5rem; text-align: center; line-height: 80px; height: 60px;">
                        <?php echo $row['MSHH']; ?>
                    </td>

                    <td style="font-size: 1.5rem; text-align: center; line-height: 80px; height: 60px;">
                        <?php echo $row['SoLuong']; ?>
                    </td>

                    <td style="font-size: 1.5rem; text-align: center; line-height: 80px; height: 60px;">
                        <?php echo $row['NgayDH'] ?>
                    </td>

                    <td style="font-size: 1.5rem; text-align: center; line-height: 80px; height: 60px;">
                        <?php echo $row['NgayGH'] ?>
                    </td>

                    <td style="font-size: 1.5rem; text-align: center; line-height: 80px; height: 60px;">
                        <?php  
                           echo $kh['HoTenKH'];
                        ?>
                    </td>

                    <td style="font-size: 1.5rem; text-align: center; line-height: 80px; height: 60px;">
                        <?php 
                            echo $kh['DiaChi'] 
                        ?>
                    </td>

                    <td style="font-size: 1.5rem; text-align: center; line-height: 80px; height: 60px;">
                        <?php 
                            echo number_format($row['GiaDatHang'], 0, ',', '.');
                        ?>
                    </td>

                     <td style="width: 100px;text-align: center;"> <div class="dropdown">
                        <div class="dropdown">
                            <a class="btn btn-secondary dropdown-toggle" href="#" role="button"         id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                <?php 
                                    $case = $row['TrangThai'];
                                    switch ($case) {
                                        case '1':
                                            echo "Đã giao";
                                            break;
                                        case '2':
                                            echo "Đang xử lý";
                                            break;
                                        case '3':
                                            echo "Hủy đơn hàng";
                                            break;
                                        default:
                                            echo "Đang xử lý";
                                            break;
                                    }
                                ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" href="?page_layout=xuly&trangthai=1&sodondathang=<?php echo $row['SoDonDH']; ?>">Đã giao hàng</a></li>
                                <li><a class="dropdown-item" href="?page_layout=xuly&trangthai=3&sodondathang=<?php echo $row['SoDonDH']; ?>&MSHH=<?php echo $row['MSHH'];?>&soluongmua=<?php echo $row['SoLuong'];?>">Hủy đơn hàng</a></li>
                            </ul>
                        </div>
                        <?php
                            $truonghop = $row['TrangThai'];
                        ?>
                     </td>
                </tr>
            <?php }; ?>
            </tbody>
        </table>
    <div>
<div>