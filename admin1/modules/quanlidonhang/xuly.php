<?php
include('../../config/db_config.php');

// Đặt múi giờ mặc định
date_default_timezone_set('Asia/Ho_Chi_Minh');

// Lấy thời gian hiện tại
$now = date('Y-m-d');

if (isset($_GET['code']) && isset($_GET['status'])) {
    $code_cart = $_GET['code'];
    $status = $_GET['status'];

    // Cập nhật trạng thái cart_status trong cơ sở dữ liệu
    switch ($status) {
        case 'moi':
            $sql_update = "UPDATE tbl_giohang SET cart_status = 0 WHERE code_cart = '$code_cart'";
            break;
        case 'danggiao':
            $sql_update = "UPDATE tbl_giohang SET cart_status = 2 WHERE code_cart = '$code_cart'";
            break;
        case 'xacnhan':
            $sql_update = "UPDATE tbl_giohang SET cart_status = 1 WHERE code_cart = '$code_cart'"; // Đã xác nhận
            break;
        default:
            // Trường hợp không hợp lệ
            break;
    }

    mysqli_query($mysqli, $sql_update);

    // Thống kê doanh thu
    $sql_lietke_dh = "SELECT * FROM tbl_cart_details, tbl_sanpham 
                      WHERE tbl_cart_details.id_sanpham = tbl_sanpham.id_sanpham 
                      AND tbl_cart_details.code_cart='$code_cart' 
                      ORDER BY tbl_cart_details.id_cart_details DESC";
    $query_lietke_dh = mysqli_query($mysqli, $sql_lietke_dh);

    // Khởi tạo các biến thống kê
    $soluongmua = 0;
    $doanhthu = 0;
    $gianhap = 0;

    // Tính toán tổng số lượng mua, doanh thu và giá nhập từ danh sách sản phẩm trong đơn hàng
    while ($row = mysqli_fetch_array($query_lietke_dh)) {
        $soluongmua += $row['soluongmua'];
        $doanhthu += $soluongmua * $row['giasp'];
        $gianhap += $soluongmua * $row['giagockm'];
    }

    // Kiểm tra xem có dữ liệu thống kê cho ngày hiện tại chưa
    $sql_thongke = "SELECT * FROM tbl_thongke WHERE ngaydat='$now'";
    $query_thongke = mysqli_query($mysqli, $sql_thongke);

    if (mysqli_num_rows($query_thongke) == 0) {
        // Nếu chưa có dữ liệu thống kê cho ngày hiện tại, thêm mới vào bảng tbl_thongke
        $loinhuan = $doanhthu - $gianhap;

        $sql_insert_thongke = "INSERT INTO tbl_thongke (ngaydat, soluongban, doanhthu, gianhap, donhang, loinhuan) 
                                VALUES ('$now', '$soluongmua', '$doanhthu', '$gianhap', 1, '$loinhuan')";
        mysqli_query($mysqli, $sql_insert_thongke);
    } else {
        // Nếu đã có dữ liệu thống kê cho ngày hiện tại, cập nhật thông tin thống kê
        $row_tk = mysqli_fetch_array($query_thongke);
        $soluongban = $row_tk['soluongban'] + $soluongmua;
        $doanhthuss = $row_tk['doanhthu'] + $doanhthu;
        $gianhaps = $row_tk['gianhap'] + $gianhap;
        $loinhuan = $doanhthuss - $gianhaps;
        $donhang = $row_tk['donhang'] + 1;

        $sql_update_thongke = "UPDATE tbl_thongke 
                                SET soluongban='$soluongban', doanhthu='$doanhthuss', gianhap='$gianhaps', 
                                    loinhuan='$loinhuan', donhang='$donhang' 
                                WHERE ngaydat='$now'";
        mysqli_query($mysqli, $sql_update_thongke);
    }

    // Chuyển hướng về trang quản lý đơn hàng sau khi thống kê được cập nhật
    header('Location: ../../index.php?action=quanlidonhang&query=lietke');

} else {
    $id = $_GET['idcart'];

    // Xóa dữ liệu từ tbl_cart và tbl_cart_details sử dụng DELETE JOIN
    $sql_xoa = "DELETE tbl_giohang, tbl_cart_details FROM tbl_giohang
                INNER JOIN tbl_cart_details 
                ON tbl_giohang.code_cart = tbl_cart_details.code_cart 
                WHERE tbl_giohang.code_cart = '$id'";

    mysqli_query($mysqli, $sql_xoa);

    header('Location: ../../index.php?action=quanlidonhang&query=lietke');
}
?>
