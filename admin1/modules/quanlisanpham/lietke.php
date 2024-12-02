<?php
// Truy vấn danh sách sản phẩm cùng danh mục
$sql_lietke_sp = "SELECT * FROM tbl_sanpham, tbl_danhmuc 
                  WHERE tbl_sanpham.id_danhmuc = tbl_danhmuc.id_danhmuc 
                  ORDER BY id_sanpham DESC";
$query_lietke_sp = mysqli_query($mysqli, $sql_lietke_sp);

?>
<div class="quanlymenu">
    <h3>Liệt kê sản phẩm </h3>

    
    <table class='lietkesp'>
        <tr class="header_lietke">
            <th>ID</th> 
            <th>Tên Sản Phẩm</th> 
            <th>Hình ảnh</th> 
            <th>Giá sp</th>
            <th>Khuyến Mãi %</th> 
            <th>Giá gốc</th> 
            <th>Số lượng</th> 
            <th>Danh mục</th>
            <th>Mã Sp</th> 
            <th>Tóm tắt</th> 
            <th>Tình trạng</th> 
            <th class="them_menu4">Quản lý</th> 
        </tr>
        <?php
        $i = 0; // Biến đếm số thứ tự
        while ($row = mysqli_fetch_array($query_lietke_sp)) {
            $i++; // Tăng số thứ tự lên 1
            ?>

            <tr>
                <th><?php echo $i ?></th> <!-- Hiển thị số thứ tự -->
                <th><?php echo $row['tensanpham'] ?></th>
                <th>
                   
                    <img src="modules/quanlisanpham/imgspham/<?php echo $row['hinhanh'] ?>" width=100px>
                </th>
                <th><?php echo $row['giasp'] ?></th> 
                <th><?php echo $row['km'] ?></th> 
                <th><?php echo $row['giagockm'] ?></th> 
                <th><?php echo $row['soluong'] ?></th>
                <th><?php echo $row['tendanhmuc'] ?></th> 
                <th><?php echo $row['id_sanpham'] ?></th> 
                <th><?php echo $row['tomtat'] ?></th> 
                <th>
                    <?php 
                    // Hiển thị trạng thái sản phẩm
                    if ($row['tinhtrang'] == 1) {
                        echo 'Còn hàng';
                    } else {
                        echo 'Hết';
                    }
                    ?>
                </th>
                <th>
                    <!-- Chức năng sửa hoặc xóa sản phẩm -->

                    <a href="modules/quanlisanpham/xuly.php?action=delete&id_sanpham=<?php echo $row['id_sanpham']; ?>"
                        onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?');">Xóa</a> |
                    <a href="index.php?action=quanlisanpham&query=sua&idsanpham=<?php echo $row['id_sanpham']?>"
                        name="suasanpham">Sửa</a>
                </th>
            </tr>
            <?php
        }
        ?>
    </table>
    

</div>
