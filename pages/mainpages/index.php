<div class="main-slider">
    <?php
    // Truy vấn ảnh trang bìa có trạng thái kích hoạt (tinhtrang = 1)
    $sql_anhtrangbia = "SELECT * FROM tbl_anhtrangbia WHERE tinhtrang=1";
    $query_anhtrangbia = mysqli_query($mysqli, $sql_anhtrangbia);
    while ($row_anhtrangbia = mysqli_fetch_array($query_anhtrangbia)) {
        ?>
        <!-- Hiển thị các ảnh trong slider -->
        <a href="#"><img class="mySlider"
                src="./admin1/modules/quanlianhbia/anhtrangbia/<?php echo $row_anhtrangbia['hinhanh'] ?>" height=auto
                width=100%></a>
    <?php } ?>
</div>

<p> </p>
<h1 style="text-align: center; background-color: black; color: white">New Arrivals</h1>

<script>
    var myIndex = 0;
    carousel();

    function carousel() {
        var i;
        var x = document.getElementsByClassName("mySlider");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none"; // Ẩn tất cả hình ảnh
        }
        myIndex++;
        if (myIndex > x.length) { myIndex = 1 } // Quay lại hình ảnh đầu tiên khi đến cuối
        x[myIndex - 1].style.display = "block"; // Hiển thị ảnh hiện tại
        setTimeout(carousel, 2000); // Đổi ảnh mỗi 2 giây
    }
</script>

<div class="main-content">
    <div class="content-section">
        <div class="maincontent">
            <?php
            // Truy vấn sản phẩm mới (tối đa 12 sản phẩm) với trạng thái kích hoạt (tinhtrang = 1)
            $sql_pro = "SELECT * FROM tbl_sanpham WHERE tinhtrang=1 LIMIT 12";
            $query_pro = mysqli_query($mysqli, $sql_pro);
            while ($row_pro = mysqli_fetch_array($query_pro)) {
                $giaspkm = 0;
                // Nếu sản phẩm có khuyến mãi, tính giá sau khuyến mãi
                if ($row_pro['km'] > 0) {
                    $giaspkm = $row_pro['giasp'] - ($row_pro['giasp'] * ($row_pro['km'] / 100));
                }
                ?>
                <!-- Hiển thị mỗi sản phẩm -->
                <ul>
                    <div class="maincontent-item">
                        <div class="maincontent-top">
                            <!-- Hiển thị phần khuyến mãi nếu có -->
                            <?php
                            if ($row_pro['km'] > 0) {
                            ?>
                                <div class="khuyenmai"><?php echo number_format($row_pro['km']) . '%' ?></div>
                            <?php
                            }
                            ?>
                            <div class="maiconten-top1">
                                <!-- Liên kết đến chi tiết sản phẩm -->
                                <a href="index.php?quanly=chitiet&idsanpham=<?php echo $row_pro['id_sanpham'] ?>"
                                   class="maincontent-img">
                                    <img src="./admin1/modules/quanlisanpham/imgspham/<?php echo $row_pro['hinhanh'] ?>">
                                </a>
                                <!-- Nút Mua Ngay -->
                                <button type="submit" title='chi tiet' class="muangay" name="chitiet"><a
                                        href="index.php?quanly=chitiet&idsanpham=<?php echo $row_pro['id_sanpham'] ?>">Mua
                                        Ngay</a></button>
                            </div>
                        </div>
                        <div class="maincontent-info">
                            <!-- Hiển thị tên sản phẩm và giá -->
                            <a href="index.php?quanly=chitiet&idsanpham=<?php echo $row_pro['id_sanpham'] ?>"
                               class="maincontent-name"><?php echo $row_pro['tensanpham'] ?></a>
                            <a href="index.php?quanly=chitiet&idsanpham=<?php echo $row_pro['id_sanpham'] ?>"
                               class="maincontent-gia">
                                <?php
                                // Hiển thị giá sau khuyến mãi nếu có
                                if ($row_pro['km'] > 0) {
                                    echo number_format($giaspkm) . 'vnd';
                                } else {
                                    echo number_format($row_pro['giasp']) . 'vnd';
                                }
                                ?>
                                <span><?php if ($row_pro['km'] > 0) {
                                    echo number_format($row_pro['giasp']) . 'vnd';
                                } ?></span>
                            </a>
                        </div>
                    </div>
                </ul>
            <?php } ?>
        </div>
    </div>
</div>

<!-- Hiển thị các bài viết blog -->
<div id="headertt">
    <h1 class="headertinhtrang" style="text-align: center"><b>BLOG</b></h1>
    <div class="journal">
        <?php
        // Truy vấn các bài viết blog có trạng thái kích hoạt (tinhtrang = 1)
        $sql_baibao = "SELECT * FROM tbl_baibao WHERE tinhtrang=1";
        $query_baibao = mysqli_query($mysqli, $sql_baibao);
        while ($row_baibao = mysqli_fetch_array($query_baibao)) {
            ?>
            <!-- Hiển thị mỗi bài viết blog -->
            <div class="journal-item">
                <!-- Hiển thị ảnh bài viết -->
                <img class="cangiua" src="./admin1/modules/quanliblog/imgblog/<?php echo $row_baibao['hinhanh'] ?>" alt=""
                    height=auto width=97%>
                <div class="journal-body">
                    <!-- Hiển thị thời gian, tiêu đề và tóm tắt bài viết -->
                    <p><?php echo $row_baibao['thoigian'] ?></p>
                    <h4 class="journal-heading"><?php echo $row_baibao['tenbaibao'] ?></h4>
                    <p><?php echo $row_baibao['tomtat'] ?></p>
                    <!-- Liên kết xem thêm bài viết -->
                    <a href="./index.php?quanly=baibao&id=<?php echo $row_baibao['id_baibao'] ?>">Xem thêm</a>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>

<?php
include('./pages/footer/footer.php');
?>

<script>
    // Giới hạn độ dài tên sản phẩm và thêm dấu "..."
    var productNames = document.querySelectorAll('.maincontent-name');
    productNames.forEach(function (productName) {
        var originalText = productName.textContent.trim();
        if (originalText.length > 13) {
            var truncatedText = originalText.slice(0, 13) + '...';
            productName.textContent = truncatedText;
        }
    });
</script>
