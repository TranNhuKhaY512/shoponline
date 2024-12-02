
<div class="main">
            <div>
                
                <?php
                    if(isset($_GET['quanly'])){
                       $tam = $_GET['quanly'];
                    }else{
                       $tam = '';
                    }
                    if($tam=='danhmuc'){
                       include('./mainpages/main/danhmuc.php');
                    }elseif($tam=='sanpham'){
                        include('./mainpages/main/sanpham.php');
                    }elseif($tam=='giohang'){
                        include('./mainpages/main/giohang.php');
                    }elseif($tam=='dangky'){
                        include('./mainpages/main/dangky.php');
                    }elseif($tam=='thanhtoan'){
                        include('./mainpages/main/thanhtoan.php');
                    }elseif($tam=='dangnhap'){
                        include('./mainpages/main/dangnhap.php');
                    }elseif($tam=='aboutus'){
                        include('./mainpages/main/aboutus.html');
                    }elseif($tam=='timkiem'){
                        include('./mainpages/main/timkiem.php');
                    }elseif($tam=='ketqua'){
                        include('./mainpages/main/ketquathanhtoan.php');
                    }elseif($tam=='shopall'){
                        include('./mainpages/main/all.php');
                    }elseif($tam=='sale'){
                        include('./mainpages/main/sale.php');
                    }elseif($tam=='chinhsach'){
                        include('./mainpages/footer/chinhsach.php');
                    }elseif($tam=='baibao'){
                        include('./mainpages/main/baibao.php');

                    }elseif($tam=='chitiet'){
                        include('./mainpages/main/chitietsp.php');

                    }elseif($tam=='thongtintaikhoann'){
                        include('./mainpages/main/thongtintaikhoan.php');
                    }elseif($tam=='suathongtintaikhoann'){
                        include('./mainpages/main/suataikhoan.php');
                    }elseif($tam=='donhang'){
                        include('./mainpages/main/donhang.php');
                    }elseif($tam=='xemdonhang'){
                        include('./mainpages/main/xemdonhang.php');
                    }elseif($tam=='xuly'){
                        include('./mainpages/main/xuly.php');
                    }elseif($tam=='hoanhang'){
                        include('./mainpages/main/hoanhang.php');
                    }else{
                        include('./mainpages/main/index.php');
                    }
                
                ?>
                
                <?php
                    include('./pages/footer/footer.php');
                ?>
             
            <div class="clear"></div>
                
            </div> 
            <div class="clear"></div>

                <?php
                    include('./pages/footer/modal.php');
                ?>
                <div class="modal">
                    
            </div>