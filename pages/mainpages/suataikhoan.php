<?php
// Kiểm tra xem form có được gửi đi hay không
if (isset($_POST['sua'])) {
    // Lấy dữ liệu cũ từ cơ sở dữ liệu dựa trên id của khách hàng
    $sql_sua_cs = "SELECT * FROM tbl_khachang WHERE tbl_khachhang.id_khachhang = '$_GET[id]' LIMIT 1";
    $query_sua_cs = mysqli_query($mysqli, $sql_sua_cs);
    $row = mysqli_fetch_array($query_sua_cs);

    // Lấy dữ liệu mới từ form (nếu có) hoặc giữ nguyên dữ liệu cũ
    $tenkhachhang = !empty($_POST['hoten']) ? $_POST['hoten'] : $row['tenkhachhang'];
    $diachi = !empty($_POST['diachi']) ? $_POST['diachi'] : $row['diachi'];
    $dienthoai = !empty($_POST['dienthoai']) ? $_POST['dienthoai'] : $row['dienthoai'];

    // Cập nhật thông tin khách hàng vào cơ sở dữ liệu
    $sql_update = "UPDATE tbl_khachhang SET tenkhachhang='".$tenkhachhang."', diachi='".$diachi."', dienthoai='".$dienthoai."' WHERE id_khachhang='$_GET[id]'";
    mysqli_query($mysqli, $sql_update);

    // Sau khi cập nhật, chuyển hướng người dùng về trang index
    header('location:./index.php');
}
?>

<?php
    // Lấy dữ liệu khách hàng hiện tại để điền vào form
    $sql_sua_cs = "SELECT * FROM tbl_khachhang WHERE tbl_khachhang.id_khachhang = '$_GET[id]' LIMIT 1";
    $query_sua_cs = mysqli_query($mysqli, $sql_sua_cs);
    while ($row = mysqli_fetch_array($query_sua_cs)) {
?>
<form action="#" method="POST">
    <div class="login-form">
        <div class="login-container">
            <a href="./index.php" class="header-zz">
                <div class="logo-wrapper">
                    <img src="./asset/img/logo.gif" alt="logo">
                </div>
            </a>
            <h2>Cập nhật thông tin tài khoản</h2>
            <!-- Tên khách hàng -->
            <a>Tên <span style="color:red">*</span></a><br>
            <input type="text" placeholder="<?php echo $row['tenkhachhang'] ?>" name="hoten" ><br>

            <!-- Điện thoại -->
            <a>Điện thoại <span style="color:red">*</span></a><br>
            <input type="text" placeholder="<?php echo $row['diachi'] ?>" name="diachi" ><br>

            <!-- Địa chỉ -->
            <a>Địa chỉ<span style="color:red">*</span></a><br>
            <input type="text" placeholder="<?php echo $row['dienthoai'] ?>" name="dienthoai"><br>

            <!-- Thông tin ẩn (email và mật khẩu không thay đổi) -->
            <input type="hidden" name="email" value="<?php echo $row['email']; ?>">
            <input type="hidden" name="matkhau" value="<?php echo $row['matkhau']; ?>">

            <!-- Nút Cập nhật -->
            <button name="sua">Cập nhật</button>

            <!-- Liên kết quay lại trang chủ -->
            <div><a href="./index.php"><p>← Quay lại trang chủ</p></a></div>
        </div>
    </div>
</form>
<div class="clear"></div>
<?php } ?>
