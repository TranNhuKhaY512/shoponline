
<div class="main">
            <div>
                
                <?php
                    if(isset($_GET['quanly'])){
                       $tam = $_GET['quanly'];
                    }else{
                       $tam = '';
                    }
                    if($tam=='danhmuc'){
                       include('./pages/mainpages/danhmuc.php');
                    // }elseif($tam=='sanpham'){
                    //     include('./pages/mainpages/sanpham.php');
                    }elseif($tam=='giohang'){
                        include('./pages/mainpages/giohang.php');
                    }elseif($tam=='dangky'){
                        include('./pages/mainpages/dangky.php');
                    }elseif($tam=='thanhtoan'){
                        include('./pages/mainpages/thanhtoan.php');
                    }elseif($tam=='dangnhap'){
                        include('./pages/mainpages/dangnhap.php');
                    }elseif($tam=='aboutus'){
                        include('./pages/mainpages/aboutus.html');
                    }elseif($tam=='timkiem'){
                        include('./pages/mainpages/timkiem.php');
                    }elseif($tam=='ketqua'){
                        include('./pages/mainpages/ketquathanhtoan.php');
                    }elseif($tam=='shopall'){
                        include('./pages/mainpages/all.php');
                    }elseif($tam=='sale'){
                        include('./pages/mainpages/sale.php');
                    }elseif($tam=='chinhsach'){
                        include('./pages/footer/chinhsach.php');
                    }elseif($tam=='baibao'){
                        include('./pages/mainpages/baibao.php');

                    }elseif($tam=='chitiet'){
                        include('./pages/mainpages/chitietsp.php');

                    }elseif($tam=='thongtintaikhoann'){
                        include('./pages/mainpages/thongtintaikhoan.php');
                    }elseif($tam=='suathongtintaikhoann'){
                        include('./pages/mainpages/suataikhoan.php');
                    }elseif($tam=='donhang'){
                        include('./pages/mainpages/donhang.php');
                    }elseif($tam=='xemdonhang'){
                        include('./pages/mainpages/xemdonhang.php');
                    }elseif($tam=='xuly'){
                        include('./pages/mainpages/xuly.php');
                    
                    }else{
                        include('./pages/mainpages/index.php');
                    }
                
                ?>
                
               
             
            <div class="clear"></div>
                
            </div> 
            <div class="clear"></div>

                <?php
                    include('./pages/footer/modal.php');
                ?>
                <div class="modal">
                    
            </div>