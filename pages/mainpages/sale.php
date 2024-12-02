<div>
    <?php
    // Kiểm tra xem có tham số 'trang' trong URL không (để xác định trang hiện tại)
    if (isset($_GET['trang'])) {
        $page = $_GET['trang']; // Gán giá trị của trang vào biến $page
    } else {
        $page = 1; // Nếu không có, mặc định trang là 1
    }

    // Xác định giá trị của $begin để giới hạn số sản phẩm mỗi trang (mỗi trang có 8 sản phẩm)
    if ($page == '' || $page == 1) {
        $begin = 0; // Nếu trang 1 hoặc không có trang, bắt đầu từ sản phẩm đầu tiên
    } else {
        $begin = ($page * 8) - 8; // Nếu trang khác, tính vị trí bắt đầu của sản phẩm (VD: trang 2 sẽ bắt đầu từ sản phẩm thứ 9)
    }

    // Truy vấn lấy sản phẩm có khuyến mãi (km > 0) và sắp xếp theo mức khuyến mãi giảm dần
    $sql_pro = "SELECT * FROM tbl_sanpham WHERE km>0 ORDER BY km DESC LIMIT $begin,8"; 
    $query_pro = mysqli_query($mysqli, $sql_pro);
    ?>

    <div class="headline">
        <h3>Khuyến Mãi</h3>
    </div>
    <div class="home-sort">
        <span class="filter-sort">Trang: <?php echo $page ?></span>
    </div>
</div>

<div class="maincontent">
    <?php
    $giaspkm = 0;
    while ($row_pro = mysqli_fetch_array($query_pro)) {
        // Nếu sản phẩm có khuyến mãi, tính giá sau khuyến mãi
        if ($row_pro['km'] > 0) {
            $giaspkm = $row_pro['giasp'] - ($row_pro['giasp'] * ($row_pro['km'] / 100));
        }
        ?>
        <!-- Hiển thị sản phẩm -->
        <ul>
            <div class="maincontent-item">
                <div class="maincontent-top">

                    <?php
                    // Nếu có khuyến mãi, hiển thị mức khuyến mãi
                    if ($row_pro['km'] > 0) {
                        ?>
                        <div class="khuyenmai"><?php echo "-" . number_format($row_pro['km']) . '%' ?></div>
                    <?php
                    }
                    ?>
                    <div class="maiconten-top1">
                        <!-- Liên kết tới chi tiết sản phẩm -->
                        <a href="index.php?quanly=chitiet&idsanpham=<?php echo $row_pro['id_sanpham'] ?>"
                            class="maincontent-img">
                            <img src="./admin1/modules/quanlisanpham/imgspham/<?php echo $row_pro['hinhanh'] ?>">
                        </a>
                        <!-- Nút "Mua Ngay" để người dùng có thể mua sản phẩm ngay -->
                        <button type="submit" title='chi tiet' class="muangay" name="chitiet"><a
                                href="index.php?quanly=chitiet&idsanpham=<?php echo $row_pro['id_sanpham'] ?>">Mua
                                Ngay</a></button>
                    </div>
                </div>
                <div class="maincontent-info">
                    <!-- Liên kết tới chi tiết sản phẩm -->
                    <a href="index.php?quanly=sanpham&id=<?php echo $row_pro['id_sanpham'] ?>"
                        class="maincontent-name"><?php echo $row_pro['tensanpham'] ?></a>
                    <a href="index.php?quanly=sanpham&id=<?php echo $row_pro['id_sanpham'] ?>"
                        class="maincontent-gia">
                        <?php 
                        // Hiển thị giá sau khuyến mãi nếu có
                        if ($row_pro['km'] > 0) {
                            echo number_format($giaspkm) . 'vnd';
                        } else {
                            echo number_format($row_pro['giasp']) . 'vnd';
                        }
                        ?>
                        <span><?php 
                        // Hiển thị giá gốc nếu có khuyến mãi
                        if ($row_pro['km'] > 0) {
                            echo number_format($row_pro['giasp']) . 'vnd';
                        } ?></span>
                    </a>
                </div>
            </div>
        </ul>
    <?php } ?>
</div>

<!-- Phân trang sản phẩm -->
<div class="content-paging">
    <?php
    // Truy vấn lấy tất cả sản phẩm có khuyến mãi để tính số trang
    $sql_trang = mysqli_query($mysqli, "SELECT * FROM tbl_sanpham WHERE km>0");
    $row_count = mysqli_num_rows($sql_trang); // Lấy tổng số sản phẩm có khuyến mãi
    $trang = ceil($row_count / 8); // Tính số trang (mỗi trang có 8 sản phẩm)
    ?>

    <div class="filter-page">
        <?php
        // Hiển thị các liên kết trang
        for ($i = 1; $i <= $trang; $i++) {
            ?>
            <a <?php 
            // Nếu là trang hiện tại, thêm kiểu CSS đặc biệt
            if ($i == $page) {
                echo 'style="color: red;background-color: #ccc;"';
            } else {
                '';
            } ?>
                href="index.php?quanly=sale&trang=<?php echo $i ?>" class="filter-page-number"><?php echo $i ?></a>
            <?php
        }
        ?>
    </div>
</div>
