<?php
    $sql_sua_chinhanh = "SELECT * FROM tbl_chinhanh WHERE id_chinhanh='$_GET[idchinhanh]' LIMIT 1"; //lấy tất cả từ tbl danh mục điều kiện 
    $query_sua_chinhanh = mysqli_query($mysqli,$sql_sua_chinhanh);

?>

<div class="quanlymenu">
            <h3>Cập nhật chi nhánh</h3>
            <table class='them_menu'>
                <form method="POST" action="./modules/quanlichinhanh/xuly.php?idchinhanh=<?php echo $_GET['idchinhanh']?>">
                <?php
                    while($dong = mysqli_fetch_array($query_sua_chinhanh)){
                ?>

                    <tr>
                        <td class="them_menu1">Cập nhật chi nhánh</td>
                        <td class="them_menu2"><input type="text" value="<?php echo $dong['chinhanh'] ?>" name="chinhanh"></td>
                    </tr>
                    <tr>
                        <td class="them_menu1">Thứ tự</td>
                        <td class="them_menu2"><input type="number" value="<?php echo $dong['thutu'] ?>" name="thutu"></td>
                    </tr>
                    <tr class="btn_thêm_menu">
                        
                        <td colspan ='2'><input type="submit" name='suachinhanh' value='Cập nhật chi nhánh'></td>
                    </tr>
                <?php
                    }
                ?>
                </form>
            </table>
</div>