<?php
// Phân trang
if (isset($_GET['trang'])) {
    $page = $_GET['trang']; // Nếu có tham số 'trang' trong URL, lấy giá trị trang
} else {
    $page = ''; // Nếu không có tham số, mặc định là trang đầu tiên
}

// Tính toán vị trí bắt đầu cho việc phân trang
if ($page == '' || $page == 1) {
    $begin = 0; // Nếu là trang đầu tiên, bắt đầu từ sản phẩm đầu tiên
} else {
    $begin = ($page * 5) - 5; // Nếu trang khác, tính toán vị trí bắt đầu cho phân trang
}
?>

<?php
$userEmail = $_SESSION['email']; // Lấy email của người dùng đã đăng nhập từ biến session

// Truy vấn danh sách đơn hàng của người dùng, giới hạn mỗi trang 5 đơn hàng
$sql_lietke_dh = "SELECT * FROM tbl_giohang, tbl_khachhang
                  WHERE tbl_giohang.id_khachhang = tbl_khachhang.id_khachhang
                  AND tbl_khachhang.email = '$userEmail' 
                  ORDER BY tbl_giohang.code_cart DESC LIMIT $begin, 5";

$query_lietke_dh = mysqli_query($mysqli, $sql_lietke_dh); // Thực thi câu truy vấn
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page Title</title>
    <link rel="stylesheet" href="styles.css"> <!-- Liên kết tới tệp CSS tùy chỉnh -->
</head>

<body>
    <!-- Các phần tử HTML của bạn -->
    <h2>Đơn hàng</h2>
    <table class="table">

        <div class="row" style="margin-top: 20px;">


            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã đơn hàng</th>
                    <th>Tên khách hàng</th>
                    <th>Địa chỉ</th>
                    <th>Email</th>
                    <th>Số điện thoại</th>
                    <th>Thời gian tạo</th>
                    <th>Tình trạng</th>
                    <th>Xác nhận</th>

                </tr>
                <?php
                $i = 0; // Khởi tạo biến đếm
                while ($row = mysqli_fetch_array($query_lietke_dh)) { // Duyệt qua từng đơn hàng
                    $currentTimestamp = time(); // Lấy thời gian hiện tại
                    $orderTimestamp = strtotime($row['time']); // Chuyển đổi thời gian tạo đơn hàng thành dấu thời gian
                
                    $i++; // Tăng biến đếm
                    ?>
                    <tr>
                        <td><?php echo $i ?></td> <!-- Hiển thị STT -->
                        <td><?php echo $row['code_cart'] ?></td> <!-- Hiển thị mã đơn hàng -->
                        <td><?php echo $row['tenkhachhang'] ?></td> <!-- Hiển thị tên khách hàng -->
                        <td><?php echo $row['diachi'] ?></td> <!-- Hiển thị địa chỉ giao hàng -->
                        <td><?php echo $row['email'] ?></td> <!-- Hiển thị email khách hàng -->
                        <td><?php echo $row['dienthoai'] ?></td> <!-- Hiển thị số điện thoại khách hàng -->
                        <td><?php echo $row['time'] ?></td> <!-- Hiển thị thời gian tạo đơn hàng -->
                        <td>
                            <?php
                            // Kiểm tra trạng thái đơn hàng và hiển thị thông tin tương ứng
                            if ($row['cart_status'] == 1) {
                                echo '<span style="color: red;">Chờ xác nhận</span>';
                                ?>
                                <div class="clear"></div>
                                <a href="index.php?quanly=xemdonhang&query=xemdonhang&code=<?php echo $row['code_cart']; ?>">Xem
                                    đơn hàng</a> <!-- Liên kết đến chi tiết đơn hàng khi chờ xác nhận -->
                                <?php
                            } elseif ($row['cart_status'] == 0) {
                                echo '<span style="color: yellow;">Đơn hàng đang được giao</span>';
                                ?>
                                <div class="clear"></div>
                                <a href="index.php?quanly=xemdonhang&query=xemdonhang&code=<?php echo $row['code_cart']; ?>">Xem
                                    đơn hàng</a> <!-- Liên kết đến chi tiết đơn hàng khi đang giao -->
                                <?php
                            } elseif ($row['cart_status'] == 2) {
                                echo '<span style="color: blue;">Đã giao hàng</span>';
                                ?>
                                <div class="clear"></div>
                                <a href="index.php?quanly=xemdonhang&query=xemdonhang&code=<?php echo $row['code_cart']; ?>">Xem
                                    đơn hàng</a> <!-- Liên kết đến chi tiết đơn hàng khi đã giao -->
                                <?php
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            // Hiển thị nút xác nhận khi đơn hàng đang được giao (status = 0)
                            if ($row['cart_status'] == 1) {
                                echo "";
                            } elseif ($row['cart_status'] == 0) {
                                ?>
                                <a href="index.php?quanly=xuly&query=xuly&code=<?php echo $row['code_cart']; ?>"
                                    class="btn btn-success">Đã nhận</a> <!-- Liên kết xác nhận đã nhận đơn hàng -->
                            <?php
                            } elseif (($currentTimestamp - $orderTimestamp) > 600000) { // Kiểm tra nếu đơn hàng đã quá 7 ngày
                                // Nếu đã qua 7 ngày, hiển thị nút "Xem đơn hàng" thay vì "Đổi trả"
                                ?>
                                <a href="index.php?quanly=xemdonhang&query=xemdonhang&code=<?php echo $row['code_cart']; ?>"
                                    class="btn btn-primary">Xem đơn hàng</a>
                                <?php
                            }
                            ?>
                        </td>


                    </tr>
                    <?php
                }
                ?>
                </tr>
            </thead>

    </table>
    </div>