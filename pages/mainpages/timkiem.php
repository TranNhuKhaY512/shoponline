<?php
$tukhoa = '';
if (isset($_POST['timkiem'])) {
    $tukhoa = $_POST['tukhoa'];
}
$sql_pro = "SELECT * FROM tbl_sanpham,tbl_danhmuc WHERE tbl_sanpham.id_danhmuc=tbl_danhmuc.id_danhmuc AND tbl_sanpham.tensanpham LIKE '%" . $tukhoa . "%'  ";
$query_pro = mysqli_query($mysqli, $sql_pro);
?>

<div class="maincontent">
    <?php
    $giaspkm = 0;
    // Tính giá giảm nếu có chương trình khuyến mãi
    while ($row_pro = mysqli_fetch_array($query_pro)) {
        if ($row_pro['km'] > 0) {
            $giaspkm = $row_pro['giasp'] - ($row_pro['giasp'] * ($row_pro['km'] / 100));
        }
        ;
        ?>

        <ul>

            <div class="maincontent-item">
                <div class="maincontent-top">

                    <?php
                    if ($row_pro['km'] == 0) {

                    } else {
                        ?>
                        <div class="khuyenmai"><?php echo number_format($row_pro['km']) . '%' ?></div>
                    <?php
                    }
                    ?>
                    <div class="maiconten-top1">

                        <a href="index.php?quanly=chitiet&idsanpham=<?php echo $row_pro['id_sanpham'] ?>"
                            class="maincontent-img">
                            <img src="./admin1/modules/quanlisanpham/imgspham/<?php echo $row_pro['hinhanh'] ?>">
                        </a>
                        <button type="submit" title='chi tiet' class="muangay" name="chitiet"><a
                                href="index.php?quanly=chitiet&idsanpham=<?php echo $row_pro['id_sanpham'] ?>">Mua
                                Ngay</a></button>

                    </div>
                </div>

                <!-- Thông tin sản phẩm -->
                <div class="maincontent-info">
                    <a href="index.php?quanly=chitiet&idsanpham=<?php echo $row_pro['id_sanpham'] ?>"
                        class="maincontent-name"><?php echo $row_pro['tensanpham'] ?></a>
                    <a href="index.php?quanly=chitiet&idsanpham=<?php echo $row_pro['id_sanpham'] ?>"
                        class="maincontent-gia"><?php if ($row_pro['km'] > 0) {
                            echo number_format($giaspkm) . 'vnd';
                        } else {
                            echo number_format($row_pro['giasp']) . 'vnd';
                        } ?>
                        <span><?php  // Hiển thị giá gốc nếu có khuyến mãi
                            if($row_pro['km'] > 0){
                                echo number_format($row_pro['giasp']).'vnd'; // Giá gốc
                            } else {
                                // Không hiển thị gì nếu không có khuyến mãi
                            }
                        ?>
                        </span></a>
                </div>
            </div>
        </ul>
        <?php
    }
    ?>

</div>