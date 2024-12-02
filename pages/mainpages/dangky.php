

<body>
    <link rel="stylesheet" href="asset/css/dk_dang nhap.css">
    <?php

ob_start();
    if (isset($_POST['dangky'])) {
        $tenkhachhang = $_POST['hoten'];
        $diachi = $_POST['diachi'];
        $dienthoai = $_POST['dienthoai'];
        $email = $_POST['email'];
        $matkhau = password_hash($_POST['matkhau'], PASSWORD_DEFAULT);
        $id = 4;

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<h3>Email không hợp lệ!</h3>";
        } else {
            $stmt = $mysqli->prepare("INSERT INTO tbl_khachhang ( tenkhachhang, diachi, dienthoai, email, matkhau, role_id) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssi", $tenkhachhang, $diachi, $dienthoai, $email, $matkhau, $id);

            if ($stmt->execute()) {
                echo '<h3>Bạn đã đăng ký thành công</h3>';
                $_SESSION['dangky'] = $tenkhachhang;
                $_SESSION['id_khachhang'] = $mysqli->insert_id;
                echo '<p></p><a href="index.php" class="btn btn-primary">Quay về trang chủ</a> </p>';
                exit();
            } else {
                echo "<h3>Đăng ký thất bại. Vui lòng thử lại sau!</h3>";
            }

            $stmt->close();
        }
    }
    ?>

    <form action="#" method="POST">
        <div class="login-form">
            <div class="login-container">
                <a href="./index.php" class="header-zz">
                    <div class="logo-wrapper">
                        <img src="admin1/img/logo.gif" alt="logo">
                    </div>
                </a>
                <h1>Đăng ký</h1>

                <input type="text" placeholder="Họ tên" name="hoten" required><br>
                <input type="text" placeholder="Địa chỉ nhận hàng" name="diachi" required><br>
                <input type="text" placeholder="Số điện thoại" name="dienthoai" required><br>
                <input type="text" placeholder="Email" name="email" required><br>
                <input type="password" placeholder="Mật Khẩu" name="matkhau" required><br>
                <button style="background-color: black; color: white;" type="submit" name="dangky">Đăng ký</button>
                <div class="links">
                    <a href="./index.php?quanly=dangnhap">
                        <p>← Quay lại đăng nhập</p>
                    </a>
                </div>
            </div>
        </div>
    </form>

</body>

</html>