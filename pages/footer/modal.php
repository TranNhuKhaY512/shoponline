<div class="modal">
    <!-- phần tìm kiếm -->
    <div>
        <!-- Checkbox để hiển thị modal tìm kiếm -->
        <input type="checkbox" class="check-timkiem-css" name="check-timkiem" id="check-timkiem">
        <!-- Label để mở modal tìm kiếm -->
        <label for="check-timkiem" class="search-them-modal "></label>

        <div class="search_modal ">
            <!-- Nút đóng modal tìm kiếm -->
            <label for="check-timkiem" class="search_modal-icon-btn ti-close"></label>

            <div class="search_modal-header">
                <p>Tìm kiếm</p> <!-- Tiêu đề modal -->
            </div>

            <!-- Form tìm kiếm -->
            <form action="index.php?quanly=timkiem" method="POST">
                <!-- Input để người dùng nhập từ khóa tìm kiếm -->
                <input id="search" type="text" class="search_modal-input" placeholder="Nhập tên sản phẩm ..."
                    name="tukhoa">

                <!-- Nút submit để thực hiện tìm kiếm -->
                <input class="search_modal_btn" type="submit" name="timkiem" value="Tìm kiếm">
            </form>

            <!-- Phần sản phẩm gợi ý -->
            <div class="cart_thamkhaao">
                <div class="cart_thamkhaao-1">
                    <h4>Có thể bạn sẽ thích</h4>
                    <!-- Liên kết để xem thêm sản phẩm -->
                    <a style=" font-size: 16px;" href="index.php?quanly=shopall">Xem thêm</a><!-- thêm chi link sản phẩm mới -->
                </div>

                <!-- Hiển thị một sản phẩm ngẫu nhiên -->
                <div class="maincontent">
                    <?php
                    // Lấy một sản phẩm ngẫu nhiên từ cơ sở dữ liệu
                    $sql_pro = "SELECT * FROM tbl_sanpham order by RAND() LIMIT 1 ";
                    $query_pro = mysqli_query($mysqli, $sql_pro);
                    $giaspkm = 0;

                    // Duyệt qua các sản phẩm để hiển thị
                    while ($row_pro = mysqli_fetch_array($query_pro)) {
                        // Tính giá sau khuyến mãi nếu có
                        if ($row_pro['km'] > 0) {
                            $giaspkm = $row_pro['giasp'] - ($row_pro['giasp'] * ($row_pro['km'] / 100));
                        }
                        ?>
                        <!-- Hiển thị sản phẩm -->
                        <ul>
                            <div class="maincontent-item">
                                <div class="maincontent-top">
                                    <?php
                                    // Nếu có khuyến mãi, hiển thị tỷ lệ giảm giá
                                    if ($row_pro['km'] > 0) {
                                    ?>
                                        <div class="khuyenmai"><?php echo number_format($row_pro['km']) . '%' ?></div>
                                    <?php
                                    }
                                    ?>
                                    <div class="maiconten-top1">
                                        <!-- Hình ảnh sản phẩm -->
                                        <a href="index.php?quanly=chitiet&idsanpham=<?php echo $row_pro['id_sanpham'] ?>"
                                            class="maincontent-img">
                                            <img
                                                src="./admin1/modules/quanlisanpham/imgspham/<?php echo $row_pro['hinhanh'] ?>">
                                        </a>

                                        <!-- Nút mua ngay -->
                                        <button type="submit" title='chi tiet' class="muangay" name="chitiet">
                                            <a href="index.php?quanly=chitiet&idsanpham=<?php echo $row_pro['id_sanpham'] ?>">Mua Ngay</a>
                                        </button>
                                    </div>
                                </div>

                                <!-- Thông tin sản phẩm -->
                                <div class="maincontent-info">
                                    <a href="index.php?quanly=chitiet&idsanpham=<?php echo $row_pro['id_sanpham'] ?>"
                                        class="maincontent-name"><?php echo $row_pro['tensanpham'] ?></a>
                                    <a href="index.php?quanly=chitiet&idsanpham=<?php echo $row_pro['id_sanpham'] ?>"
                                        class="maincontent-gia">
                                        <!-- Hiển thị giá sau khuyến mãi nếu có -->
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
            </div>
        </div>
    </div>
</div>

<script>
    // Lấy danh sách tất cả các phần tử có class 'maincontent-name'
    var productNames = document.querySelectorAll('.maincontent-name');

    // Giới hạn chiều dài của tên sản phẩm và thêm dấu "..." nếu cần
    productNames.forEach(function (productName) {
        var originalText = productName.textContent.trim();
        // Nếu tên sản phẩm dài hơn 13 ký tự, cắt bớt và thêm "..."
        if (originalText.length > 13) {
            var truncatedText = originalText.slice(0, 13) + '...';
            productName.textContent = truncatedText;
        }
    });
</script>
