<?php
include("config/db_config.php");
$sqli = "SELECT * FROM tbl_khachhang,tbl_role where tbl_role.role_id= tbl_khachhang.role_id order by `id_khachhang` ";
$query = mysqli_query($mysqli, $sqli);

if (!$query) {
  echo "<div class='error'>Lỗi: " . mysqli_error($mysqli) . "</div>";
}
?>
<div class="quanlymenu">
  <h2>Liệt kê thành viên</h2>
  <?php
// ktra điều kiện nếu role_id = 1 thì hiển thị thêm nút thêm thành viên
  if ($_SESSION['role_id'] == 1) {
    ?>
    <a href="index.php?action=quanlithanhvien&query=them"><button class="btn btn-success">Thêm Thành Viên</button></a>
  <?php
  } else {
  }
  ?>
  <table class="table table-bordered table-hover" style="margin-top: 20px; border: 2px solid">

    <tr style="border:1px solid">
      <th>STT</th>
      <th>Họ và tên</th>
      <th>Địa chỉ</th>
      <th>Số điện thoại</th>
      <th>Email</th>
      <th>Quyền</th>
      <th colspan="2">Quản lý</th>
    </tr>

    <?php
    $i = 0;
    while ($row = mysqli_fetch_array($query)) {
      $i++;

      if ($row['role_id'] != 1 && $row['role_id'] != 4) {
        ?>
        <th><?php echo $i ?></th>
        <th><?php echo $row['tenkhachhang'] ?></th>
        <th><?php echo $row['diachi'] ?></th>
        <th><?php echo $row['dienthoai'] ?></th>
        <th><?php echo $row['email'] ?></th>
        <th><?php echo $row['name'] ?></th>
        <?php

        if ($_SESSION['role_id'] == 1) {
          ?>
          <script>
            // Hàm để xử lý xóa
            function confirmDelete(id) {
              if (confirm('Bạn có chắc chắn muốn xóa?')) {
                window.location.href = 'modules/quanlithanhvien/xuly.php?idkhachhang=' + id;
              }
            }
          </script>

          <th>
            <a href="javascript:void(0);" onclick="confirmDelete(<?php echo $row['id_khachhang']; ?>)">
              <button class="btn btn-danger">Xóa</button>
            </a>
          </th>

        <?php
        } else {

          ?>
          <th width="80px">Ẩn</th>
        <?php } ?>

        <!-- sửa -->
        <?php

        if ($_SESSION['role_id'] == 1) {
          ?>

          <th>
            <a href="?action=quanlithanhvien&query=sua&idkhachhang=<?php echo $row['id_khachhang'] ?> ">
              <button class="btn btn-warning">Sửa</button>
            </a>
          </th>

        <?php
        } else {

          ?>
          <th width="80px">Ẩn</th>
        <?php } ?>


        </tr>

      <?php } ?>

      <?php
    }
    ?>

  </table>
</div>