<?php
    $sql_lietke_cs = "SELECT * FROM tbl_chinhsach,tbl_tenchinhsach WHERE tbl_chinhsach.id_tenchinhsach=tbl_tenchinhsach.id_tenchinhsach ORDER BY id_chinhsach ASC";
    $query_lietke_cs = mysqli_query($mysqli,$sql_lietke_cs);

?>

<div class="quanlymenu" style="text-align: center;
    width: 850px;
    margin-top: 90px;">
            <h3>Liệt kê chính sách </h3>

            <table class='lietkesp' >
                    <tr class="header_lietke">
                        <th>ID</th>
                      
                        <th>Danh muc</th>
                        <th>Nội dung</th>
                        <th>Tình trạng</th> 
                        
                        <th class="them_menu4">Quản lý</th>
                    </tr>
                    <?php
                        $i=0;
                        while($row = mysqli_fetch_array($query_lietke_cs)){
                            $i++;
                    ?>
                    
                    <tr>
                        <th><?php echo $i ?></th>
                        
                        <th><?php echo $row['tenchinhsach'] ?></th>
                        <th class="noidungchinhsach" ><?php echo substr($row['noidung'], 0, 50) . '...'; ?></th>
                        <th><?php  if($row['tinhtrang']==1){
                                    echo 'Kích hoạt';
                                    }else{
                                        echo 'Ẩn';
                                    }
            
                            ?>
                        </th>
<script>
    // Hàm để xử lý xóa
    function confirmDelete(id) {
    if (confirm('Bạn có chắc chắn muốn xóa?')) {
        window.location.href = 'modules/quanlichinhsach/xuly.php?idchinhsach=' + id;
    }
    }
</script>
                        <th>
                            <a href="javascript:void(0);" onclick="confirmDelete(<?php echo $row['id_chinhsach']; ?>)">Xóa</a>  |  
                            <a href="index.php?action=quanlichinhsach&query=sua&idchinhsach=<?php echo $row['id_chinhsach']?>">Sửa</a> 
                        </th>
                    </tr>
                    <?php
                        }
                    ?>
                </form>
            </table>

        </div>