<?php
include('../../config/db_config.php');

// Thêm thành viên mới
if (isset($_POST['themmember'])) {
    // Lấy dữ liệu từ form
    $tenkhachhang = $_POST['tenkhachhang'];
    $diachi = $_POST['diachi'];
    $dienthoai = $_POST['dienthoai'];
    $email = $_POST['email'];
    $matkhau = password_hash($_POST['matkhau'], PASSWORD_DEFAULT); // Mã hóa mật khẩu
    $role_id = $_POST['role_id'];

    // SQL INSERT để thêm người dùng mới
    $sql_insert = "INSERT INTO tbl_khachhang (tenkhachhang, diachi, dienthoai, email, matkhau, role_id) 
                   VALUES ('$tenkhachhang', '$diachi', '$dienthoai', '$email', '$matkhau', '$role_id')";
    
    // Thực thi câu lệnh SQL và kiểm tra kết quả
    if (mysqli_query($mysqli, $sql_insert)) {
        // Chuyển hướng người dùng về danh sách thành viên nếu thêm thành công
        header('Location: ../../index.php?action=quanlithanhvien&query=lietke');
    } else {
        // In ra lỗi nếu có vấn đề với truy vấn
        echo "Lỗi: " . mysqli_error($mysqli);
    }
}
?>

<!-- Cập nhật thông tin thành viên -->
<?php
include('../../config/db_config.php');

// Cập nhật thông tin thành viên
if (isset($_POST['suathanhvien'])) {
    // Lấy dữ liệu từ form
    $id = $_POST['id'];
    $tenkhachhang = $_POST['tenkhachhang'];
    $diachi = $_POST['diachi'];
    $dienthoai = $_POST['dienthoai'];
    $email = $_POST['email'];
    $role_id = $_POST['role_id'];

    // SQL UPDATE để cập nhật thông tin thành viên
    $sql_update = "UPDATE tbl_khachhang 
                   SET tenkhachhang='$tenkhachhang', diachi='$diachi', dienthoai='$dienthoai', email='$email', role_id='$role_id' 
                   WHERE id_khachhang='$id'";

    // Thực thi câu lệnh SQL và kiểm tra kết quả
    if (mysqli_query($mysqli, $sql_update)) {
        // Chuyển hướng về danh sách thành viên nếu cập nhật thành công
        header('Location: ../../index.php?action=quanlithanhvien&query=lietke');
    } else {
        // In ra lỗi nếu có vấn đề với truy vấn
        echo "Lỗi: " . mysqli_error($mysqli);
    }
}
?>

<!-- Xóa thành viên -->
<?php
include('../../config/db_config.php');

// Xử lý xóa thành viên
if (isset($_GET['idkhachhang'])) {
    $id = $_GET['idkhachhang'];

    // Sử dụng prepared statements để tránh SQL injection
    $stmt = $mysqli->prepare("DELETE FROM tbl_khachhang WHERE id_khachhang = ?");
    $stmt->bind_param("i", $id); // Liên kết tham số ID

    // Thực thi câu lệnh SQL và kiểm tra kết quả
    if ($stmt->execute()) {
        // Chuyển hướng về danh sách thành viên nếu xóa thành công
        header('Location: ../../index.php?action=quanlithanhvien&query=lietke');
    } else {
        // In ra lỗi nếu có vấn đề với truy vấn
        echo "Lỗi: " . $stmt->error;
    }

    // Đóng statement sau khi thực hiện
    $stmt->close();
}
?>
