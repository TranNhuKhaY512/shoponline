<?php
if(isset($_GET['code'])){
    $code = $_GET['code'];
    
    // Thực hiện kết nối CSDL và truy vấn cập nhật trạng thái
    $sql_update="UPDATE tbl_giohang SET cart_status = 2 WHERE code_cart = '$code'";
		$query = mysqli_query($mysqli,$sql_update);
    
    // Kiểm tra xem truy vấn đã thành công hay không
    if($query){
        // Truy vấn thành công, chuyển hướng người dùng về trang danh sách đơn hàng hoặc trang khác
        header('Location:index.php?quanly=donhang');
    } else {
        // Truy vấn không thành công, xử lý lỗi hoặc hiển thị thông báo lỗi cho người dùng
        echo "Lỗi: " . mysqli_error($mysqli);
    }
    // Thay thế 'previous_page.php' bằng URL của trang bạn muốn chuyển hướng đến
}
?>
