<?php
session_start(); // Khởi tạo session để quản lý giỏ hàng
include('../../admin1/config/db_config.php'); // Kết nối với cơ sở dữ liệu

// Thêm số lượng sản phẩm vào giỏ hàng
if (isset($_GET['cong'])) {
    $id = $_GET['cong']; // Lấy ID sản phẩm cần cộng thêm số lượng
    foreach ($_SESSION['cart'] as &$cart_item) {
        if ($cart_item['id'] == $id) {
            $cart_item['soluong'] += 1; // Tăng số lượng sản phẩm
            if ($cart_item['soluong'] > 9) {
                $cart_item['soluong'] = 9; // Giới hạn số lượng tối đa là 9
            }
        }
    }
    header('Location:../../index.php?quanly=giohang'); // Chuyển hướng về giỏ hàng
}

// Giảm số lượng sản phẩm trong giỏ hàng
if (isset($_GET['tru'])) {
    $id = $_GET['tru']; // Lấy ID sản phẩm cần giảm số lượng
    foreach ($_SESSION['cart'] as &$cart_item) {
        if ($cart_item['id'] == $id) {
            $cart_item['soluong'] -= 1; // Giảm số lượng sản phẩm
            if ($cart_item['soluong'] < 1) {
                $cart_item['soluong'] = 1; // Đảm bảo số lượng tối thiểu là 1
            }
        }
    }
    header('Location:../../index.php?quanly=giohang'); // Chuyển hướng về giỏ hàng
}

// Xóa sản phẩm khỏi giỏ hàng
if (isset($_SESSION['cart']) && isset($_GET['xoa'])) {
    $id = $_GET['xoa']; // Lấy ID sản phẩm cần xóa
    
    // Duyệt qua mỗi sản phẩm trong giỏ hàng để tìm và xóa
    foreach ($_SESSION['cart'] as $key => $cart_item) {
        if ($cart_item['id'] == $id) {
            unset($_SESSION['cart'][$key]); // Xóa sản phẩm khỏi giỏ hàng
            break; // Thoát khỏi vòng lặp sau khi xóa
        }
    }

    header('Location:../../index.php?quanly=giohang'); // Chuyển hướng về giỏ hàng
}

// Xóa một sản phẩm khỏi giỏ hàng (khác với xóa theo GET['xoa'])
if (isset($_SESSION['cart']) && isset($_GET['xoa1'])) {
    $id = $_GET['xoa1']; // Lấy ID sản phẩm cần xóa
    $product = [];

    // Duyệt qua giỏ hàng và tạo một giỏ hàng mới không có sản phẩm cần xóa
    foreach ($_SESSION['cart'] as $cart_item) {
        if ($cart_item['id'] != $id) {
            $product[] = array(
                'tensanpham' => $cart_item['tensanpham'],
                'id' => $cart_item['id'],
                'soluong' => $cart_item['soluong'],
                'giasp' => $cart_item['giasp'],
                'hinhanh' => $cart_item['hinhanh'],
                'masp' => $cart_item['masp']
            );
        }
    }

    $_SESSION['cart'] = $product; // Cập nhật lại giỏ hàng với các sản phẩm còn lại
    header('Location:../../index.php'); // Chuyển hướng về trang chủ
}

// Xóa toàn bộ giỏ hàng
if (isset($_GET['xoatatca']) && $_GET['xoatatca'] == 1) {
    unset($_SESSION['cart']); // Xóa toàn bộ giỏ hàng
    header('Location:../../index.php?quanly=giohang'); // Chuyển hướng về giỏ hàng
}

// Thêm sản phẩm vào giỏ hàng
if (isset($_POST['themgiohang'])) {
    $id = $_GET['idsanpham']; // Lấy ID sản phẩm cần thêm vào giỏ hàng

    // Kiểm tra xem có tồn tại giá trị soluong và kichthuoc không
    if (isset($_POST['soluong']) && isset($_POST['kichthuoc'])) {
        $soluong = $_POST['soluong']; // Lấy số lượng sản phẩm từ form
        $size = $_POST['kichthuoc']; // Lấy size sản phẩm từ form

        // Lấy thông tin sản phẩm từ cơ sở dữ liệu
        $sql = "SELECT * FROM tbl_sanpham WHERE id_sanpham='".$id."' LIMIT 1";
        $query = mysqli_query($mysqli, $sql);
        $row = mysqli_fetch_array($query);

        if ($row) {
            // Tạo một mảng sản phẩm mới để thêm vào giỏ hàng
            $new_product = array(
                'tensanpham' => $row['tensanpham'],
                'id' => $id,
                'soluong' => $soluong,
                'giasp' => $row['giasp'],
                'hinhanh' => $row['hinhanh'],
                'masp' => $row['masp'],
                'size' => $size // Lưu size vào mảng sản phẩm
            );

            // Kiểm tra xem giỏ hàng đã có sản phẩm này chưa
            if (isset($_SESSION['cart'])) {
                $found = false;
                foreach ($_SESSION['cart'] as &$cart_item) {
                    if ($cart_item['id'] == $id && $cart_item['size'] == $size) {
                        $cart_item['soluong'] += $soluong; // Cộng thêm số lượng nếu sản phẩm và size đã có
                        $found = true;
                        break;
                    }
                }

                // Nếu không có sản phẩm này trong giỏ hàng, thêm sản phẩm mới
                if (!$found) {
                    $_SESSION['cart'][] = $new_product;
                }
            } else {
                $_SESSION['cart'][] = $new_product; // Nếu giỏ hàng chưa có, thêm sản phẩm mới
            }
        } else {
            echo "Không tìm thấy sản phẩm với ID: " . $id;
        }
    } else {
        echo "Không có giá trị soluong hoặc kichthuoc được gửi từ form.";
    }

    header('Location: ' . $_SERVER['HTTP_REFERER']); // Quay lại trang sản phẩm
}

// Mua ngay (thêm sản phẩm vào giỏ và chuyển hướng tới giỏ hàng)
if (isset($_POST['muangay'])) {
    $id = $_GET['idsanpham']; // Lấy ID sản phẩm

    if (isset($_POST['soluong']) && isset($_POST['kichthuoc'])) {
        $soluong = $_POST['soluong']; // Lấy số lượng từ form
        $size = $_POST['kichthuoc']; // Lấy size từ form

        // Lấy thông tin sản phẩm từ cơ sở dữ liệu
        $sql = "SELECT * FROM tbl_sanpham WHERE id_sanpham='".$id."' LIMIT 1";
        $query = mysqli_query($mysqli, $sql);
        $row = mysqli_fetch_array($query);

        if ($row) {
            $new_product = array(
                'tensanpham' => $row['tensanpham'],
                'id' => $id,
                'soluong' => $soluong,
                'giasp' => $row['giasp'],
                'hinhanh' => $row['hinhanh'],
                'masp' => $row['masp'],
                'size' => $size // Lưu size vào giỏ hàng
            );

            if (isset($_SESSION['cart'])) {
                $found = false;
                foreach ($_SESSION['cart'] as &$cart_item) {
                    if ($cart_item['id'] == $id && $cart_item['size'] == $size) {
                        $cart_item['soluong'] += $soluong; // Cộng thêm số lượng nếu sản phẩm và size đã có
                        $found = true;
                        break;
                    }
                }

                if (!$found) {
                    $_SESSION['cart'][] = $new_product;
                }
            } else {
                $_SESSION['cart'][] = $new_product;
            }
        }
    }
    header('Location:../../index.php?quanly=giohang'); // Quay lại giỏ hàng
}

var_dump($_POST); // In thông tin POST ra để kiểm tra
?>
