<?php
// session_start();
$sql_danhmuc = "SELECT * FROM `tbl_danhmuc` ORDER BY `tbl_danhmuc`.`thutu` ASC";
$query_danhmuc = mysqli_query($mysqli, $sql_danhmuc);
?>

<div class="sidebar">
<div class="toggle-sidebar-btn" onclick="toggleSidebar()">
   <span class="open-icon">&#9776;</span>

    </div>
    <a href="./index.php" class="header-slb"><img style="margin-top:50px;" src="admin1/img/logotext_1.gif" alt="logo" height="10%" width="50%"></a>
    <ul>
        <li><a href="index.php?quanly=shopall"><i class="ti-hand-point-right"></i> Tất cả </a></li>
        <li>
            <a href="index.php?quanly=sale" class="my-custom-link">
                <i class="ti-hand-point-right"></i> Khuyến mãi
                <span class="badge badge-danger badge-pill text-uppercase">Sale</span>
            </a>
        </li>

        <?php
        while ($row_danhmuc = mysqli_fetch_array($query_danhmuc)) {
        ?>
            <li><a href="index.php?quanly=danhmuc&id=<?php echo $row_danhmuc['id_danhmuc'] ?>"><i class="ti-hand-point-right"></i><?php echo $row_danhmuc['tendanhmuc'] ?></a></li>
        <?php
        }
        ?>

        <div class="lienhe_tick">
            <li><a href="#"><i class="ti-hand-point-right"></i> Liên hệ</a></li>
            <ul class="lienhe">
            <li><a href="https://www.facebook.com/TobiStreetwear" target="_blank"><i class="ti-hand-point-right"></i> Facebook</a></li>
        <li><a href="https://www.instagram.com/tobiclo/" target="_blank"><i class="ti-hand-point-right"></i> Instagram</a></li>
        <li><a href="mailto:contact@tobi.vn"><i class="ti-hand-point-right"></i> Email</a></li>
            </ul>
        </div>
        <li><a href="index.php?quanly=donhang"><i class="bi bi-bag"></i> Đơn hàng</a></li>


    </ul>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var sidebar = document.querySelector('.sidebar'); // Lấy phần tử sidebar
    var toggleBtn = document.querySelector('.toggle-sidebar-btn'); // Lấy nút toggle để mở/đóng sidebar
    var isSidebarExpanded = false; // Biến kiểm tra trạng thái của sidebar (được mở rộng hay không)
    var timer; // Biến lưu trữ ID của timer

    if (sidebar && toggleBtn) {
        // Lắng nghe sự kiện click vào nút toggle
        toggleBtn.addEventListener('click', function(event) {
            event.stopPropagation(); // Ngừng sự kiện click lan ra ngoài nút toggle-sidebar-btn
            isSidebarExpanded = true; // Đánh dấu sidebar đang mở rộng
            sidebar.classList.add('expanded'); // Thêm lớp 'expanded' vào sidebar để mở rộng
            // Thiết lập timer để tự động đóng sidebar sau 5 giây
            timer = setTimeout(function() {
                sidebar.classList.remove('expanded'); // Xóa lớp 'expanded' để thu gọn sidebar
                isSidebarExpanded = false; // Đánh dấu sidebar đã thu gọn
            }, 5000); // Thời gian 5000ms (5 giây)
        });

        // Lắng nghe sự kiện khi chuột rời khỏi sidebar
        sidebar.addEventListener('mouseleave', function() {
            if (isSidebarExpanded) {
                clearTimeout(timer); // Hủy bỏ timer nếu chuột rời khỏi sidebar trước khi hết thời gian 5 giây
                isSidebarExpanded = false; // Đánh dấu sidebar đã thu gọn
            } else {
                sidebar.classList.remove('expanded'); // Nếu sidebar chưa mở rộng, xóa lớp 'expanded'
            }
        });

        //  click vào sidebar để ngừng sidebar lan ra ngoài
        sidebar.addEventListener('click', function(event) {
            event.stopPropagation(); // Ngừng click lan ra ngoài sidebar
        });

        // click vào body để đóng sidebar nếu đang mở
        document.body.addEventListener('click', function() {
            if (isSidebarExpanded) {
                clearTimeout(timer); // Hủy bỏ timer nếu bạn click ngoài sidebar
                sidebar.classList.remove('expanded'); // Đóng sidebar
                isSidebarExpanded = false; // Đánh dấu sidebar đã thu gọn
            }
        });
    }
});
</script>
