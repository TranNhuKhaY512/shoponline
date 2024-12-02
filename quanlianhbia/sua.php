<?php
//truy vấn dữ liệu - chỉ lấy 1 ảnh 
    $sql_sua_anhtrangbia = "SELECT * FROM tbl_anhtrangbia WHERE id_anhtrangbia='$_GET[idanhtrangbia]' LIMIT 1";
    $query_sua_anhtrangbia = mysqli_query($mysqli,$sql_sua_anhtrangbia);

?>
<div class="quanlymenuchung">
            <h3>Cập nhật ảnh trang bìa</h3>
<table class='thêm_menu'>
<?php
    while($row = mysqli_fetch_array($query_sua_anhtrangbia)){
         // Hiển thị form cập nhật với dữ liệu của từng dòng (chỉ 1 dòng vì LIMIT 1).
?>  
<form method="POST" action="./modules/quanlianhbia/xuly.php?idanhtrangbia=<?php echo $_GET['idanhtrangbia']?>" enctype="multipart/form-data"> 
    <!-- muon gui hinh anh qua post phai them enctype(bắt buộc) -->
        
        <tr>
            <td class="thêm_menu">Hình ảnh</td>
            <td class="thêm_menu">
                <input type="file"  name="hinhanh">
                
                <img src="modules/quanlianhbia/anhtrangbia/<?php echo $row['hinhanh']?>" width=100px >
            </td>
        </tr>

        <tr>
            <td class="thêm_menu">thứ tự</td>
            <td class="thêm_menu"><textarea rows="5" name="thutu"><?php echo $row['thutu'] ?> </textarea></td>
        </tr>
        <tr>
            <td class="thêm_menu">Tình trạng</td>
            <td class="thêm_menu">
                <select name="tinhtrang">
                    <?php
                        if($row['tinhtrang']==1){
                    ?>
                    <option value="1" selected>Kích hoạt</option>
                    <option value="0">Ẩn</option>
                    <?php
                        }else{
                    ?>
                    <option value="1" >Kích hoạt</option>
                    <option value="0" selected>Ẩn</option>
                    <?php
                        }
                    ?>
                </select>
            </td>
        </tr>
        
        <tr class="btn_thêm_menu">
            
            <td colspan ='2'><input type="submit" name='suaanhtrangbia' value='Cập nhật ảnh trang bìa'></td>
        </tr>
    </form>
<?php
    }
?>
</table></div>