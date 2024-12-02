
<?php
// Bắt đầu session trước khi xuất bất kỳ nội dung nào
ob_start();  // Khởi tạo session

// Kiểm tra đăng nhập
if(isset($_POST['dangnhap'])){
    $email = $_POST['email']; // Lấy giá trị email từ form
    $matkhau = $_POST['password']; // Lấy giá trị mật khẩu từ form

    // Thực hiện truy vấn để tìm tài khoản người dùng dựa trên email
    $sql = "SELECT * FROM tbl_khachhang WHERE email='".$email."' LIMIT 1"; 
    $row = mysqli_query($mysqli, $sql); // Thực hiện truy vấn
    $count = mysqli_num_rows($row); // Kiểm tra có bao nhiêu bản ghi trả về

    if($count > 0){ // Nếu có tài khoản với email này
        $row_data = mysqli_fetch_array($row); // Lấy dữ liệu người dùng
        // Kiểm tra mật khẩu có khớp không
        if(password_verify($matkhau, $row_data['matkhau'])){ // So sánh mật khẩu với mật khẩu đã hash
            $_SESSION['dangky'] = $row_data['tenkhachhang']; 
            $_SESSION['id_khachhang'] = $row_data['id_khachhang']; 
            $_SESSION['role_id'] = $row_data['role_id']; 
            $_SESSION['email'] = $row_data['email']; 
            switch($_SESSION['role_id']) {
                case 4:
                    echo '<script>window.location.href = "index.php";</script>';
                    break;
                default:
                    echo '<script>window.location.href = "admin1/index.php";</script>';
                    break;
            }
            exit();
        } else {
            echo '<script>alert("Tài khoản hoặc Mật khẩu không đúng, vui lòng nhập lại.");</script>';
        }
}
}
?>

<script>
// Kiểm tra form trước khi gửi
function validateForm() {
    var email = document.forms["loginForm"]["email"].value; // Lấy giá trị email
    var password = document.forms["loginForm"]["password"].value; // Lấy giá trị mật khẩu
    if (email == "" || password == "") { // Kiểm tra xem email và mật khẩu có để trống không
        alert("Vui lòng nhập đầy đủ thông tin tài khoản và mật khẩu."); // Hiển thị thông báo lỗi
        return false; // Ngừng gửi form
    }
}
</script>

<!-- Form đăng nhập -->
<form name="loginForm" action="" method="POST" onsubmit="return validateForm()"> <!-- Gọi validateForm khi form được gửi -->
    <div class="login-form">
        <div class="login-container">
            <a href="./index.php" class="header-zz">
                <div class="logo-wrapper">
                    <img src="admin1/img/logo.gif" alt="logo">
                </div>
            </a>
            <h2>Đăng nhập</h2>
            <label for="email">Email <span style="color:red">*</span></label><br>
            <input type="email" name="email" required><br> 
            <label for="password">Password <span style="color:red">*</span></label><br>
            <input type="password" name="password" required><br> 
            <button type="submit" name="dangnhap">Đăng nhập</button>
            <i>hoặc</i>
            <div class="links">
                <a href="./index.php">← Quay lại trang chủ</a> 
                <a href="./index.php?quanly=dangky">Đăng ký →</a> 
            </div>
            <?php
            // Hiển thị thông báo lỗi nếu có
            if(isset($error_message)){
                echo '<p style="color: red;">' . $error_message . '</p>'; // Hiển thị thông báo lỗi trong trường hợp đăng nhập thất bại
            }
            ?>
        </div>
    </div>
</form>
<div class="clear"></div>
