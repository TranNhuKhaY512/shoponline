<?php
// Đảm bảo biến $code tồn tại và không rỗng
// Kiểm tra xem tham số 'code_cart' đã được truyền qua URL hay chưa
if (isset($_GET['code'])) {
  $code = mysqli_real_escape_string($mysqli, $_GET['code']);

  // Lấy giá trị của tham số 'code_cart' và xử lý để ngăn chặn SQL injection

  $sql_lietke_dh = "SELECT tbl_cart_details.*, tbl_sanpham.*, size.ten_size
  FROM tbl_cart_details
  INNER JOIN tbl_sanpham ON tbl_cart_details.id_sanpham = tbl_sanpham.id_sanpham
  INNER JOIN size ON tbl_cart_details.size = size.id_size
  WHERE tbl_cart_details.code_cart = '" . $code . "'
  ORDER BY tbl_cart_details.id_cart_details DESC;
  ";


  // Thực hiện truy vấn SQL và kiểm tra kết quả
  $query_lietke_dh = mysqli_query($mysqli, $sql_lietke_dh);
}
if (isset($_POST['phanhoi'])) {
  // Lấy nội dung phản hồi từ form
  $noidung = mysqli_real_escape_string($mysqli, $_POST['noidung']);
  $code = $_GET['code'];

  // Truy vấn SQL để lấy id_dangky từ tbl_dangky


  $id_khachhang = $_SESSION['id_khachhang'];

}



?>
<div class="row" style="margin-top: 20px;">
  <div class="col-md-12 table-responsive">
    <h3 class="the_h">Xem đơn hàng</h3>
    <table class="table table-bordered table-hover" style="margin-top: 20px;">
      <thead>
        <tr>
          <th>Mã đơn hàng</th>
          <th>Tên sản phẩm</th>
          <th>Hình ảnh</th>
          <th>Số lượng</th>
          <th>Mã sp</th>
          <th>Kích thước</th>


        </tr>
      </thead>
      <?php

      while ($row = mysqli_fetch_array($query_lietke_dh)) {

        ?>
        <tr style="text-align: center;">

          <td><?php echo $row['code_cart'] ?></td>
          <td><?php echo $row['tensanpham'] ?></td>
          <th><img style="width:50px;max-height:80px;"
              src="admin1/modules/quanlisanpham/imgspham/<?php echo $row['hinhanh']; ?>"></th>


          <td><?php echo $row['soluongmua'] ?></td>
          <td><?php echo $row['id_sanpham'] ?></td>
          <th><?php echo $row['ten_size'] ?></th>



        </tr>
        <?php
      }
      ?>

    </table>