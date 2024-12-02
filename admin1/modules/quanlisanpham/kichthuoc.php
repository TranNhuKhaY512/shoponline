
<div class="quanlymenuchung">
<a href="index.php?action=quanlisanpham&query=them"><-- Quay lại trang</a>

            <h3>Thêm kích thước</h3>
            <table class='thêm_menu'>
                <form method="POST" action="./modules/quanlisanpham/xuly.php" >
                    <tr>
                        <td class="thêm_menu">Thêm kích thước</td>
                        <td class="thêm_menu"><input type="text" name="tenkichthuoc" value=""></td>
                    </tr>
                    <tr>
                        <td class="thêm_menu">Thứ tự</td>
                        <td class="thêm_menu"><input type="number" name="thutu" value="Thứ Tự"></td>
                    </tr>
                    <tr class="thêm_menu">
                        
                        <td colspan ='2' ><input type="submit" name='themkichthuoc' value='Thêm danh mục menu'></td>
                    </tr>
                </form>
            </table>
</div>
<?php
    $sql_lietke_size = "SELECT * FROM size ORDER BY thutu ASC"; // goi tat cả dữ liệu từ tbl danh mục theo thứ tự từ nhỏ đến lớn
    $query_lietke_size = mysqli_query($mysqli,$sql_lietke_size);  //truy xuất dữ liệu vào 
    
?>
<div class="quanlymenuchung">
    <h3>Liệt kê danh mục sản phẩm </h3>

    <table class='lietke_menu' >
            <tr class="header_lietke">
                <td>ID</td>
                <td class="thêm_menu">Tên Size</td>
                <td class="thêm_menu">Quản lý</td>
            </tr>
            <?php
                $i=0;
                while($row = mysqli_fetch_array($query_lietke_size)){
                    $i++;
                //gán tất cả dữ liệu vào $row và i tăng dần
            ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $row['ten_size'] ?></td>
                <td>

                    <a href="./modules/quanlisanpham/xuly.php?idsize=<?php echo $row['id_size']?>">Xóa</a>  | 

                </td>
            </tr>
            <?php
                }
            ?>
        </form>
    </table>
 </div>