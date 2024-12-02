<!--truy vấn từ database bảng sản phẩm  -->
<?php
$sql_sanpham = "SELECT 
		tbl_sanpham.*, 
		size_soluong.id_size, 
		size_soluong.soluongsize AS soluongconlai,
		SUM(tbl_cart_details.soluongmua) AS total_quantity 
	FROM 
		tbl_sanpham 
	LEFT JOIN 
		tbl_cart_details ON tbl_sanpham.id_sanpham = tbl_cart_details.id_sanpham
	LEFT JOIN 
		size_soluong ON tbl_sanpham.id_sanpham = size_soluong.ma_sanpham
	WHERE 
		tbl_sanpham.id_sanpham = '$_GET[idsanpham]' 
		AND tbl_sanpham.tinhtrang = 1 
	GROUP BY 
		tbl_sanpham.id_sanpham, size_soluong.id_size 
	LIMIT 1";

$query_sanpham = mysqli_query($mysqli, $sql_sanpham);

$giaspkm = 0;
while ($row_sanpham = mysqli_fetch_array($query_sanpham)) {
    $soluongcon = 0;
    $soluongcon = $row_sanpham['soluong'] - $row_sanpham['total_quantity'];
    if ($row_sanpham['km'] > 0) {
        $giaspkm = $row_sanpham['giasp'] - ($row_sanpham['giasp'] * ($row_sanpham['km'] / 100));
    }
    ;
    ?>
    <?php


    // Thực hiện truy vấn dữ liệu kích thước từ CSDL

    $sql_sizes = "SELECT size.*, size_soluong.id_size_soluong, size_soluong.soluongsize, size_soluong.soluongdaban 
FROM size 
LEFT JOIN size_soluong ON size.id_size = size_soluong.id_size 
WHERE size_soluong.ma_sanpham = '$_GET[idsanpham]'";
    $result_sizes = $mysqli->query($sql_sizes);

    // Kiểm tra và gán giá trị cho biến $listSizes
    $listSizes = [];
    if ($result_sizes && $result_sizes->num_rows > 0) {
        while ($row = $result_sizes->fetch_assoc()) {
            $soluongban = $row_sanpham['total_quantity'];

            $soluongconlai = $row['soluongsize'] - $row['soluongdaban'];
            if ($soluongconlai > 0) {
                $row['soluongconlai'] = $soluongconlai;
                $listSizes[] = $row;
            }
        }
    }
    ?>
    <!-- Hiển thị chi tiết sản phẩm -->
    <div>
        <div id="product">
            <div id="backtoshop">
                <a href="./index.php" class="ti-angle-left">back to new arrivals</a>
            </div>
        </div>
        <div class="product-container">

            <div class="product-detail-wapper">
                <div class="detail-wapper-info">
                    <div class="product-images">
                        <div class="product-big-image">
                            <img src="./admin1/modules/quanlisanpham/imgspham/<?php echo $row_sanpham['hinhanh'] ?>" alt="">
                        </div>
                    </div>
                    <div class="product-details">
                        <div class="product-info">
                            <h1><?php echo $row_sanpham['tensanpham'] ?></h1>

                            <?php
                            // Tính tổng số lượng còn lại
                            $totalRemainingQuantity = 0;
                            foreach ($listSizes as $size) {
                                $totalRemainingQuantity += $size['soluongconlai'];
                            }
                            ?>

                            <!-- Thông tin đánh giá sản phẩm -->
                            <div class="product-rating">
                                <span class="star-rating">4.2 &#9733;&#9733;&#9733;&#9733;&#9734;</span>
                                <span class="separator">|</span><!-- 4 sao -->
                                <span class="review-count"><?php echo $soluongban; ?> Đánh Giá</span>
                                <span class="separator">|</span>
                                <span class="sold-count"><?php echo $soluongban; ?> đã bán</span>
                            </div>




                            <!-- Hiển thị tổng số lượng còn lại -->
                            <h4>Số lượng còn lại:
                                <?php echo ($totalRemainingQuantity <= 0) ? 'Hết hàng' : $totalRemainingQuantity; ?></h4>

                            <form id="productForm" method="POST"
                                action="./pages/mainpages/themgiohang.php?idsanpham=<?php echo $row_sanpham['id_sanpham'] ?>"
                                onsubmit="return validateForm()">
                                <div class="size-options">
                                    <?php foreach ($listSizes as $size) { ?>
                                        <div data-value="<?php echo $size['id_size']; ?>" class="size-option">
                                            <input class="size-radio" id="size-<?php echo $size['id_size']; ?>" type="radio"
                                                name="kichthuoc" value="<?php echo $size['id_size']; ?>"
                                                onchange="enableQuantity(<?php echo $size['soluongconlai']; ?>)">
                                            <label for="size-<?php echo $size['id_size']; ?>" class="size-label">
                                                <span><?php echo $size['ten_size']; ?> </span>
                                            </label>
                                        </div>
                                    <?php } ?>
                                </div>

                                <div class="product-quantity-selection">
                                    <p id="soluong-label">Số lượng: </p>
                                    <input type="number" id="soluong" name="soluong" min="1" max="1" disabled
                                        oninput="updateQuantityLabel(this.value)">
                                </div>


                        </div>
                        <div class="detail-right-info-price">
                            <p><?php if ($row_sanpham['km'] > 0) {
                                echo number_format($giaspkm) . 'vnd';
                            } else {
                                echo number_format($row_sanpham['giasp']) . 'vnd';
                            } ?><span><?php if ($row_sanpham['km'] > 0) {
                                 echo number_format($row_sanpham['giasp']) . 'vnd';
                             } else {

                             } ?></span></p>
                        </div>
                             <!-- Nút thêm vào giỏ hàng và mua ngay -->
                        <div class="product-buttons">
                            <?php if ($totalRemainingQuantity > 0) { ?>
                                <button type="submit" name="themgiohang" class="add-to-cart-button"
                                    onclick="return validateSizeSelection();">
                                    <i class="fas fa-shopping-cart"></i>
                                    <span>Thêm vào giỏ hàng</span>
                                </button>
                                <button type="submit" name="muangay" class="buy-now-button"
                                    onclick="return validateSizeSelection();">
                                    <i class="fas fa-shopping-bag"></i>
                                    <span>Mua Ngay</span>
                                </button>
                            <?php } else { ?>
                                <div class="sold-out-message">
                                    Hết hàng
                                </div>
                            <?php } ?>
                        </div>

                        <!-- Thông tin giao hàng và hỗ trợ -->

                        <div class="delivery-info">
                            <div class="delivery-info-item">
                                <div class="delivery-info-icon"><a href="index.php?quanly=chinhsach&id=6"><i
                                            class="fas fa-truck"></i></a></div>
                                <span>Giao hàng nhanh<br>Từ 2 - 5 ngày</span>
                            </div>
                            <div class="delivery-info-item">
                                <div class="delivery-info-icon"><i class="fas fa-shipping-fast"></i></div>
                                <span>Freeship toàn quốc từ 1.200.000<br>Miễn phí vận chuyển<br>Đơn hàng từ 900.000</span>
                            </div>
                            <div class="delivery-info-item">
                                <div class="delivery-info-icon"><a href="index.php?quanly=donhang"><i
                                            class="fas fa-search"></i></a></div>
                                <span>Theo dõi đơn hàng dễ dàng<br>Đổi trả linh hoạt</span>
                            </div>
                            <div class="delivery-info-item">
                                <div class="delivery-info-icon"><a href="index.php?quanly=chinhsach&id=4"><i
                                            class="fas fa-credit-card"></i></a></div>
                                <span>Thanh toán dễ dàng<br>Nhiều hình thức<br>Hotline hỗ trợ 0900109999</span>
                            </div>
                        </div>
                    </div>

                </div>

                </form>

                <div class="product-description">
                    <div class="description-content">
                        <div class="description-productdetail">
                            <h2>Giới thiệu sản phẩm</h2>
                            <p><?php echo $row_sanpham['tomtat'] ?></p>
                            <hr>
                            <p>
                                <strong>TOBI™&nbsp;&nbsp;</strong>
                                ✦
                                <strong>&nbsp;&nbsp;</strong>
                                STREETWEAR BRAND LIMITED&nbsp;&nbsp;✦
                            </p>
                            Copyright © 2021, TOBI Streetwear. All rights reserved &nbsp;&nbsp;
                            <p>&nbsp;</p>
                            <p>&nbsp;</p>
                            <p>&nbsp;</p>
                            <p>&nbsp;</p>
                            <p>&nbsp;</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <div class="splienquan">
        <h1 style="text-align:center;">Sản phẩm liên quan<h1>
    </div>
    <div class="maincontent">

        <?php
        $sql_pro = "SELECT * FROM tbl_sanpham order by RAND() LIMIT 4 ";
        $query_pro = mysqli_query($mysqli, $sql_pro);
        $giaspkm = 0;
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

                                <button type="submit" title='chi tiet' class="muangay" name="chitiet"><a
                                        href="index.php?quanly=chitiet&idsanpham=<?php echo $row_pro['id_sanpham'] ?>">Mua
                                        Ngay</a></button>

                        </div>
                    </div>
                    <div class="maincontent-info">
                        <a href="index.php?quanly=chitiet&idsanpham=<?php echo $row_pro['id_sanpham'] ?>"
                            class="maincontent-name"><?php echo $row_pro['tensanpham'] ?></a>
                        <a href="index.php?quanly=chitiet&idsanpham=<?php echo $row_pro['id_sanpham'] ?>"
                            class="maincontent-gia"><?php if ($row_pro['km'] > 0) {
                                echo number_format($giaspkm) . 'vnd';
                            } else {
                                echo number_format($row_pro['giasp']) . 'vnd';
                            } ?>
                            <span><?php if ($row_pro['km'] > 0) {
                                echo number_format($row_pro['giasp']) . 'vnd';
                            } else {

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
    <?php
    include('./pages/footer/footer.php');
    ?>
</div>
<script>
    // Cập nhật nhãn số lượng khi người dùng thay đổi số lượng
    function updateQuantityLabel(soluong) {
        var soluongLabel = document.getElementById("soluong-label");
        soluongLabel.textContent = "Số lượng: " + soluong; // Cập nhật văn bản của nhãn
    }

    // Lấy danh sách tất cả các phần tử có class 'maincontent-name'
    var productNames = document.querySelectorAll('.maincontent-name');

    // Giới hạn chiều dài của tên sản phẩm và thêm dấu "..." nếu cần
    productNames.forEach(function (productName) {
        var originalText = productName.textContent.trim(); // Lấy tên sản phẩm gốc
        if (originalText.length > 13) { // Nếu tên dài hơn 13 ký tự
            var truncatedText = originalText.slice(0, 13) + '...'; // Cắt tên và thêm "..."
            productName.textContent = truncatedText; // Cập nhật tên sản phẩm
        }
    });

    // Bật trường nhập số lượng và thiết lập giá trị tối đa cho nó
    function enableQuantity(maxQuantity) {
        var quantityInput = document.getElementById("soluong");
        quantityInput.removeAttribute("disabled"); // Bật trường nhập số lượng
        quantityInput.setAttribute("max", maxQuantity); // Thiết lập giá trị tối đa
        quantityInput.value = 1; // Đặt giá trị mặc định là 1
    }
</script>

<script>
    // Kiểm tra và bật trường nhập số lượng khi người dùng chọn kích thước
    function enableQuantity(maxSoluong) {
        var soluongInput = document.getElementById('soluong');
        var selectedSize = document.querySelector('input[name="kichthuoc"]:checked'); // Lấy kích thước đã chọn

        // Nếu người dùng đã chọn kích thước
        if (selectedSize) {
            soluongInput.disabled = false; // Bật trường nhập số lượng
            soluongInput.max = maxSoluong; // Thiết lập số lượng tối đa
            soluongInput.value = 1; // Đặt số lượng mặc định là 1
        } else {
            soluongInput.disabled = true; // Nếu chưa chọn kích thước, vô hiệu hóa trường nhập số lượng
        }
    }

    // Kiểm tra form khi người dùng cố gắng gửi dữ liệu
    function validateForm() {
        var soluongInput = document.getElementById('soluong');
        var soluongNhap = parseInt(soluongInput.value); // Lấy giá trị số lượng nhập vào

        // Kiểm tra xem số lượng có hợp lệ không (lớn hơn 0)
        if (soluongNhap <= 0) {
            alert("Số lượng không hợp lệ. Vui lòng chọn một kích thước và nhập số lượng hợp lệ.");
            return false; // Ngừng form gửi nếu không hợp lệ
        }
        return true; // Chấp nhận gửi form nếu hợp lệ
    }
</script>

<script>
    // Kiểm tra người dùng đã chọn kích thước trước khi thêm vào giỏ hàng
    function validateSizeSelection() {
        var selectedSize = document.querySelector('input[name="kichthuoc"]:checked'); // Lấy kích thước đã chọn
        if (!selectedSize) { // Nếu không có kích thước nào được chọn
            alert("Vui lòng chọn kích thước trước khi thêm vào giỏ hàng.");
            return false; // Ngừng thao tác nếu chưa chọn kích thước
        }
        return true; // Chấp nhận nếu đã chọn kích thước
    }
</script>
