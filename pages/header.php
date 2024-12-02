<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">



<?php
if (isset($_GET['dangxuat']) && $_GET['dangxuat'] == 1) {
    unset($_SESSION['dangky']);
    unset($_SESSION['cart']);

}// Khi khách hàng thêm sản phẩm vào giỏ hàng


// Khi họ đăng nhập, bạn có thể truy cập $_SESSION['cart'] để lấy thông tin giỏ hàng của họ

?>

<div class="header">

    <a href="index.php">
        <div class="logo-header pd-28">TOBI STUDIO</div>
    </a>
    <div class="account-links pd-28">
        <?php
        if (isset($_SESSION['dangky'])) {
            ?>
            <a href="./index.php?quanly=thongtintaikhoann&id=<?php echo $_SESSION['id_khachhang'] ?>"
                id="login"><?php echo $_SESSION['dangky']; ?></a>
            /
            <a href="index.php?dangxuat=1" id="regist">Đăng xuất</a>
            <?php
        } else {
            ?>

            <a href="./index.php?quanly=dangnhap" id="login">Đăng nhập</a>
            |
            <a href="./index.php?quanly=dangky" id="regist">Đăng ký</a>
            |
            <a href="./index.php?quanly=aboutus">About Us</a>
            <?php
        }
        ?>

    </div>

    <div class="search-box">
        <form action="index.php?quanly=timkiem" method="POST" class="search-text">
            <button type="submit" name="timkiem" class="btn-search">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
            <input type="text" name="tukhoa" class="search-text-1" placeholder="Nhập tên sản phẩm" required>
        </form>
    </div>



    <div class="cart-shopping pd-28">
        <a style="color: white;
    text-decoration: none;" href="index.php?quanly=giohang">
            <i class="fa-solid fa-cart-shopping">
                <?php
                if (isset($_SESSION['cart'])) {
                    $soluongsanpham = count($_SESSION['cart']);
                    echo "(" . $soluongsanpham . ")";
                }
                ?>
            </i></a>
        <div class="cart-hover">
            <table id="cart-table">
                <!-- Sản phẩm trong giỏ hàng sẽ được hiển thị ở đây -->
            </table>
        </div>

    </div>


</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var cartTable = document.createElement('table'); // Tạo bảng giỏ hàng
        var cartHover = document.querySelector('.cart-hover'); // Lấy phần tử có class 'cart-hover'
        cartHover.appendChild(cartTable); // Thêm bảng vào phần tử 'cart-hover'

        <?php
        // Kiểm tra xem giỏ hàng có sản phẩm hay không
        if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
            // Lặp qua từng sản phẩm trong giỏ hàng
            foreach ($_SESSION['cart'] as $cart_item) {
                // Lấy thông tin size từ cơ sở dữ liệu dựa trên ID size
                $sql = "SELECT ten_size FROM size WHERE id_size = " . $cart_item['size'];
                $result = mysqli_query($mysqli, $sql);
                $row = mysqli_fetch_assoc($result);

                $ab = $cart_item['hinhanh']; // Lấy hình ảnh sản phẩm
                $a = $cart_item['tensanpham']; // Lấy tên sản phẩm
                $soluongsanpham = $cart_item['soluong']; // Lấy số lượng sản phẩm
                $aa = $row['ten_size']; // Lấy tên size sản phẩm
                $productId = $cart_item['id']; // Lấy ID sản phẩm để tạo liên kết
                ?>
                // Tạo một hàng mới trong bảng
                var row = cartTable.insertRow();
                var cell1 = row.insertCell(0); // Tạo cột 1 (hình ảnh)
                var cell2 = row.insertCell(1); // Tạo cột 2 (tên sản phẩm)
                var cell3 = row.insertCell(2); // Tạo cột 3 (số lượng)
                var cell4 = row.insertCell(3); // Tạo cột 4 (size)

                // Tạo phần tử hình ảnh và gán thuộc tính
                var productImage = document.createElement('img');
                productImage.src = './admin1/modules/quanlisanpham/imgspham/<?php echo $cart_item['hinhanh'] ?>'; // Đường dẫn hình ảnh sản phẩm
                productImage.alt = ''; // Thuộc tính alt của hình ảnh
                productImage.className = 'cart-product-image'; // Thêm class cho hình ảnh
                cell1.appendChild(productImage); // Thêm hình ảnh vào cột 1

                // Tạo liên kết đến trang chi tiết sản phẩm
                var productLink = document.createElement('a');
                productLink.href = 'index.php?quanly=chitiet&idsanpham=<?php echo $productId; ?>'; // Liên kết đến chi tiết sản phẩm
                productLink.textContent = '<?php echo $a; ?>'; // Tên sản phẩm
                cell2.appendChild(productLink); // Thêm tên sản phẩm vào cột 2

                cell3.textContent = 'Số lượng: <?php echo $soluongsanpham; ?>'; // Hiển thị số lượng sản phẩm
                cell4.textContent = 'Size: <?php echo $aa; ?>'; // Hiển thị size sản phẩm
                <?php
            }
        } else {
            ?>
            // Nếu giỏ hàng trống, hiển thị thông báo
            var emptyRow = cartTable.insertRow();
            var emptyCell = emptyRow.insertCell(0);
            emptyCell.colSpan = 4; // Cột chiếm toàn bộ bảng
            emptyCell.textContent = 'Giỏ hàng trống'; // Hiển thị thông báo giỏ hàng trống
            <?php
        }
        ?>
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
    crossorigin="anonymous"></script>