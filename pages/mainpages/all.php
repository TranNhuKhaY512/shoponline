<div>
    <?php
    // Kiểm tra xem có tham số 'trang' trong URL không
    if (isset($_GET['trang'])) {
        $page = $_GET['trang']; // Nếu có, gán biến $page bằng số trang trong URL
    } else {
        $page = 1; // Nếu không có, mặc định trang là trang 1
    }

    // Tính giá trị bắt đầu (begin) cho câu truy vấn SQL, mỗi trang hiển thị 8 sản phẩm
    if ($page == '' || $page == 1) {
        $begin = 0; // Nếu trang là trang 1, bắt đầu từ 0
    } else {
        $begin = ($page * 8) - 8; // Nếu không, bắt đầu từ $page * 8 - 8
    }

    // Truy vấn SQL để lấy danh sách sản phẩm kèm số lượng đã mua từ giỏ hàng
    $sql_pro = "SELECT tbl_sanpham.*, SUM(tbl_cart_details.soluongmua) AS total_quantity 
    FROM tbl_sanpham 
    LEFT JOIN tbl_cart_details ON tbl_sanpham.id_sanpham = tbl_cart_details.id_sanpham
    WHERE tbl_sanpham.id_sanpham  AND tbl_sanpham.tinhtrang = 1 
    GROUP BY tbl_sanpham.id_sanpham 
    DESC LIMIT $begin,36"; // Lấy tối đa 36 sản phẩm bắt đầu từ $begin
    $query_pro = mysqli_query($mysqli, $sql_pro);
    ?>

</div>

<div class="maincontent">
    <?php
    $giaspkm = 0;
    // Duyệt qua từng sản phẩm trả về từ truy vấn
    while ($row_pro = mysqli_fetch_array($query_pro)) {
        // Tính giá sau khi giảm giá nếu có
        if ($row_pro['km'] > 0) {
            $giaspkm = $row_pro['giasp'] - ($row_pro['giasp'] * ($row_pro['km'] / 100));
        }
        // Tính số lượng còn lại sau khi đã bán
        $soluongcon = 0;
        $soluongcon = $row_pro['soluong'] - $row_pro['total_quantity'];
    ?>

        <ul>
            <div class="maincontent-item">
                <div class="maincontent-top">

                    <?php
                    // Nếu sản phẩm có khuyến mãi, hiển thị tỷ lệ khuyến mãi
                    if ($row_pro['km'] > 0) {
                    ?>
                        <div class="khuyenmai"><?php echo number_format($row_pro['km']) . '%' ?></div>
                    <?php
                    }
                    ?>

                    <div class="maiconten-top1">
                        <!-- Liên kết đến trang chi tiết sản phẩm -->
                        <a href="index.php?quanly=chitiet&idsanpham=<?php echo $row_pro['id_sanpham'] ?>"
                            class="maincontent-img">
                            <img src="./admin1/modules/quanlisanpham/imgspham/<?php echo $row_pro['hinhanh'] ?>">
                        </a>
                        <!-- Nút mua ngay -->
                        <button type="submit" title='chi tiet' class="muangay" name="chitiet">
                            <a href="index.php?quanly=chitiet&idsanpham=<?php echo $row_pro['id_sanpham'] ?>">Mua Ngay</a>
                        </button>
                    </div>
                </div>

                <div class="maincontent-info">
                    <!-- Hiển thị tên sản phẩm và giá -->
                    <a href="index.php?quanly=chitiet&idsanpham=<?php echo $row_pro['id_sanpham'] ?>"
                        class="maincontent-name"><?php echo $row_pro['tensanpham'] ?></a>
                    <a href="index.php?quanly=chitiet&idsanpham=<?php echo $row_pro['id_sanpham'] ?>"
                        class="maincontent-gia">
                        <!-- Hiển thị giá sản phẩm sau khi giảm giá nếu có -->
                        <?php if ($row_pro['km'] > 0) {
                            echo number_format($giaspkm) . 'vnd';
                        } else {
                            echo number_format($row_pro['giasp']) . 'vnd';
                        } ?>
                        <span><?php if ($row_pro['km'] > 0) {
                            echo number_format($row_pro['giasp']) . 'vnd';
                        } ?>
                        </span></a>
                </div>
            </div>
        </ul>

    <?php
    }
    ?>
</div>

<div class="content-paging">
    <?php
    // Lấy tổng số sản phẩm để tính toán số trang
    $sql_trang = mysqli_query($mysqli, "SELECT * FROM tbl_sanpham  ");
    $row_count = mysqli_num_rows($sql_trang);
    // Tính tổng số trang dựa trên tổng số sản phẩm và mỗi trang hiển thị 8 sản phẩm
    $trang = ceil($row_count / 20);
    ?>

    <?php
    // Bao gồm footer của trang
    include('./pages/footer/footer.php');
    ?>
</div>

<script>
    // Lấy danh sách tất cả các phần tử có class 'maincontent-name'
    var productNames = document.querySelectorAll('.maincontent-name');

    // Giới hạn chiều dài của tên sản phẩm và thêm dấu "..." nếu cần
    productNames.forEach(function (productName) {
        var originalText = productName.textContent.trim();
        if (originalText.length > 13) {
            var truncatedText = originalText.slice(0, 13) + '...';
            productName.textContent = truncatedText;
        }
    });

    
