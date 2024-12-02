<?php
// thực hiện truy vấn db
    $sql_lietke_anhtrangbia = "SELECT * FROM tbl_anhtrangbia ORDER BY thutu ASC"; // goi tat cả dữ liệu từ tbl anhtrangbia theo thứ tự từ nhỏ đến lớn
    $query_lietke_anhtrangbia = mysqli_query($mysqli,$sql_lietke_anhtrangbia);  //truy xuất dữ liệu vào 
    
?>
<div class="quanlymenuchung">
    <h3>Liệt kê ảnh trang bìa </h3>

    <table class='lietke_menu'>
            <tr class="header_lietke">
                <td>ID</td>
                <td class="thêm_menu" style="width: 300px;">Hình ảnh</td>
                <td>Tình trạng</td>
                <td class="thêm_menu">Quản lý</td>
            </tr>
            <?php
            //tăng i để đánh stt và lấy dữu liệu từng dòng 
                $i=0;
                while($row = mysqli_fetch_array($query_lietke_anhtrangbia)){
                    $i++;
                //gán tất cả dữ liệu vào $row và i tăng dần
            ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><img src="modules/quanlianhbia/anhtrangbia/<?php echo $row['hinhanh']?>" width=100px ></td>
                <td><?php  if($row['tinhtrang']==1){
                                    echo 'Kích hoạt';
                                    }else{
                                        echo 'Ẩn';
                                    }
            
                            ?>
                        </td>
                <td>

                    <a href="./modules/quanlianhbia/xuly.php?idanhtrangbia=<?php echo $row['id_anhtrangbia']?>">Xóa</a>  |  
                    <a href="index.php?action=quanlianhbia&query=sua&idanhtrangbia=<?php echo $row['id_anhtrangbia']?>">Sửa</a> 

                </td>
            </tr>
            <?php
                }
            ?>
        </form>
    </table>
 </div>
