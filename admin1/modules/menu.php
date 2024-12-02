<link rel="stylesheet" href="css/style.css">
<div class="sidebar">
    
    <!-- Quản lý trang chủ -->
    <div class="menu-item">
        <a  class="menu-title">
            <span class="material-icons-sharp">home</span>
            <h3>Quản lý trang chủ</h3>
            <span class="material-icons-sharp">chevron_right</span>
        </a>
        <div class="hover-menu">
            <a href="index.php?action=quanlilienhe&query=them" class="hover-item">
                <span class="material-icons-sharp">add_circle</span>
                <p>Thêm liên hệ</p>
            </a>
            <a href="index.php?action=quanlichinhanh&query=them" class="hover-item">
                <span class="material-icons-sharp">store</span>
                <p>Thêm chi nhánh</p>
            </a>
            <a href="index.php?action=quanlianhbia&query=them" class="hover-item">
                <span class="material-icons-sharp">image</span>
                <p>Ảnh trang bìa</p>
            </a>
        </div>
    </div>

     <!-- Quản lý sản phẩm -->
     <div class="menu-item">
        <a class="menu-title">
            <span class="material-icons-sharp">inventory_2</span>
            <h3>Quản lý sản phẩm</h3>
            <span class="material-icons-sharp">chevron_right</span>
        </a>
        <div class="hover-menu">
            <a href="index.php?action=quanlisanpham&query=them" class="hover-item">
                <span class="material-icons-sharp">add_box</span>
                Thêm sản phẩm
            </a>
            <a href="index.php?action=quanlisanpham&query=lietke" class="hover-item">
            <span class="material-icons-sharp">playlist_play</span>
                Danh sách sản phẩm
            </a>
            <a href="index.php?action=quanlimenu&query=them" class="hover-item">
                <span class="material-icons-sharp">category</span>
                Quản lý danh mục
            </a>
        </div>
    </div>
<!-- quản lí đơn hàng -->
    <a href="index.php?action=quanlidonhang&query=lietke">
        <span class="material-icons-sharp">shopping_cart</span>
        <h3>Quản lý đơn hàng</h3>
    </a>


    <?php
        if(isset($_GET['dangxuat'])&&$_GET['dangxuat']==1){
            unset($_SESSION['dangnhap']);
            header('Location:../index.php');
        }
    ?>
    <?php

if( $_SESSION['role_id'] == 1){
  //admin
 ?>
 <!-- Quản lý chính sách -->
 <div class="menu-item">
        <a class="menu-title">
            <span class="material-icons-sharp">policy</span>
            <h3>Quản lý chính sách</h3>
            <span class="material-icons-sharp">chevron_right</span>
        </a>
        <div class="hover-menu">
        <a href="index.php?action=quanlitenchinhsach&query=them" class="hover-item">
        <span class="material-icons-sharp">category</span>
                <p>Tên chính sách </p>
            </a>
            <a href="index.php?action=quanlichinhsach&query=them" class="hover-item">
                <span class="material-icons-sharp">add_circle</span>
                <p>Thêm chính sách</p>
            </a>
            <a href="index.php?action=quanlichinhsach&query=lietke" class="hover-item">
                <span class="material-icons-sharp">list_alt</span>
                <p>Danh sách chính sách</p>
            </a>
        </div>
    </div>
  <!-- Quản lý tin tức -->
  <div class="menu-item">
        <a class="menu-title">
            <span class="material-icons-sharp">newspaper</span>
            <h3>Quản lý tin tức</h3>
            <span class="material-icons-sharp">chevron_right</span>
</a>
        <div class="hover-menu">
        
            <a href="index.php?action=quanliblog&query=them" class="hover-item">
                <span class="material-icons-sharp">post_add</span>
                <p>Thêm bài viết</p>
            </a>
            <a href="index.php?action=quanliblog&query=lietke" class="hover-item">
                <span class="material-icons-sharp">article</span>
                <p>Danh sách bài viết</p>
            </a>
        </div>
    </div>

 <!-- Quản lý người dùng -->
 <div class="menu-item">
    <a class="menu-title">
        <span class="material-icons-sharp">people</span>
        <h3>Quản lý người dùng</h3>
        <span class="material-icons-sharp">chevron_right</span>
    </a>
    <div class="hover-menu">
        <a href="index.php?action=quanlithanhvien&query=them" class="hover-item">
            <span class="material-icons-sharp">person_add</span>
            <p>Thêm thành viên</p>
        </a>
        <a href="index.php?action=quanlithanhvien&query=lietke" class="hover-item">
            <span class="material-icons-sharp">group</span>
            <p>Danh sách thành viên</p>
        </a>
    </div>
</div>

<!-- Quản lí kho -->
    <a href="index.php?action=quanlikho&query=lietke">
    <span class="material-icons-sharp">warehouse</span>
    <h3>Quản lý kho</h3>
    </a>


    <?php 
//  Quản lý role = 2 
}else{
?>

<div class="menu-item">
        <a class="menu-title">
            <span class="material-icons-sharp">newspaper</span>
            <h3>Quản lý Blogs</h3>
            <span class="material-icons-sharp">chevron_right</span>
        </a>
        <div class="hover-menu">
            <a href="index.php?action=quanliblog&query=them" class="hover-item">
                <span class="material-icons-sharp">post_add</span>
                <p>Thêm bài viết</p>
            </a>
            <a href="index.php?action=quanliblog&query=lietke" class="hover-item">
                <span class="material-icons-sharp">article</span>
                <p>Danh sách bài viết</p>
            </a>
        </div>
    </div>

    <div class="menu-item">
        <a class="menu-title">
            <span class="material-icons-sharp">home</span>
            <h3>Quản lý trang chủ</h3>
            <span class="material-icons-sharp">chevron_right</span>
        </a>
        <div class="hover-menu">
            <a href="index.php?action=quanlilienhe&query=them" class="hover-item">
                <span class="material-icons-sharp">add_circle</span>
                <p>Thêm liên hệ</p>
            </a>
            <a href="index.php?action=quanlichinhanh&query=them" class="hover-item">
                <span class="material-icons-sharp">store</span>
                <p>Thêm chi nhánh</p>
            </a>
            <a href="index.php?action=anhtrangbia&query=them" class="hover-item">
                <span class="material-icons-sharp">image</span>
                <p>Ảnh trang bìa</p>
            </a>
        </div>
    </div>

    <div >
    <a href="#" >
        <span class="material-icons-sharp">newspaper</span>
        <h3>  Quản lý Blogs</h3>
    </a>
        <div class="dmsidebar">
            <a href="index.php?action=quanlibaibao&query=them">Thêm blog</a>
            <a href="index.php?action=quanlibaibao&query=lietke">Liệt kê blogs </a>
        </div>
    </div>
    <?php 
}
?>
    <div>
        <a href="index.php?dangxuat=1"><?php if(isset($_SESSION['dangnhap'])){
		echo $_SESSION['dangnhap'];}
        ?>
            <span class="material-icons-sharp">logout</span>
            <h3>Đăng xuất</h3>

        </a>
    </div>
  
</div>
