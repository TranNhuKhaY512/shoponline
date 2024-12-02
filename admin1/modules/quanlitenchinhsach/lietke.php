<?php
    $sql_lietke_tenchinhsach = "SELECT * FROM tbl_tenchinhsach ORDER BY thutu ASC"; // goi tat cả dữ liệu từ tbl danh mục theo thứ tự từ nhỏ đến lớn
    $query_lietke_tenchinhsach = mysqli_query($mysqli,$sql_lietke_tenchinhsach);  //truy xuất dữ liệu vào 
    
?>
<div class="quanlymenu">
    <h3>Liệt kê tên chính sách </h3>

    <table class='lietke_menu' >
            <tr class="header_lietke">
                <td>ID</td>
                <td class="them_menu2" style="width: 300px;">Tên chính sách</td>
                <td class="them_menu4">Quản lý</td>
            </tr>
            <?php
                $i=0;
                while($row = mysqli_fetch_array($query_lietke_tenchinhsach)){
                    $i++;
                //gán tất cả dữ liệu vào $row và i tăng dần
            ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $row['tenchinhsach'] ?></td>
                <td>
                <a href="./modules/quanlitenchinhsach/xuly.php?idtenchinhsach=<?php echo $row['id_tenchinhsach']?>"
                        onclick="return confirm('Bạn có chắc chắn muốn xóa tên chính sách sản này không?');">Xóa</a> |
                    <a href="index.php?action=quanlitenchinhsach&query=sua&idtenchinhsach=<?php echo $row['id_tenchinhsach']?>"
                        name="suasanpham">Sửa</a>

                </td>
            </tr>
            <?php
                }
            ?>
        </form>
    </table>
 </div>