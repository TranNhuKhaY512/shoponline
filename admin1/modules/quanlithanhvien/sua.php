<?php

$sqli = "SELECT * FROM tbl_khachhang,tbl_role where tbl_khachhang.role_id = tbl_role.role_id AND `id_khachhang` = '$_GET[idkhachhang]' LIMIT 1 ";
$query = mysqli_query($mysqli, $sqli);



while ($row = mysqli_fetch_array($query)) {
    ?>
    <!DOCTYPE html>
    <html>
    <body">
        <div class="sua_thanh_viên">
            <h3>Cập nhật Tài Khoản Người Dùng</h3>
            <div class="panel panel-primary">
                <div class="panel-body">
                    <form method="POST" action="./modules/quanlithanhvien/xuly.php">
                        <table class="tb_sửa_thành_viên">
                            <tr>
                                <input type="hidden" name="id" value="<?php echo $row['id_khachhang']; ?>">
                            </tr>
                            <tr>
                                <td>Tên khách hàng</td>
                                <td class="thongtin"><input type="text" name="tenkhachhang" value="<?php echo $row['tenkhachhang']; ?>" required></td>
                            </tr>
                            <tr>
                                <td>Địa chỉ</td>    
                                <td class="thongtin"><input type="text" name="diachi" value="<?php echo $row['diachi']; ?>" required></td>
                            </tr>
                            <tr>
                                <td>Số điện thoại</td>
                                <td class="thongtin"><input type="text" name="dienthoai" value="<?php echo $row['dienthoai']; ?>" required></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td class="thongtin"><input type="email" name="email" value="<?php echo $row['email']; ?>" required></td>
                            </tr>
                            <tr>
                                <td>Chức vụ</td>
                                <td><select name="role_id" class="thongtin_role">
                                    <option value="1" <?php if ($row['role_id'] == 1)
                                            echo 'selected'; ?>>Quản trị viên</option>
                                    <option value="2" <?php if ($row['role_id'] == 2)
                                        echo 'selected'; ?>>Nhân viên</option>
                                    <option value="4" <?php if ($row['role_id'] == 4)
                                        echo 'selected'; ?>>khách hàng</option>
                                    </select></td>
                            </tr>
                            <tr>
                            <td colspan ='2'><input type="submit" name="suathanhvien" class="btn btn-success" value="Cập nhật" style="text-align: center;"></input></td>
                            </tr>
                        
                        </table>
                    </form>
<?php } ?>
               
            </div>

        </div>
        <!-- ktra password và xác nhận trùng khớp  -->
        <script type="text/javascript">
            function validateForm() {
                $pwd = $('#pwd').val();
                $confirmPwd = $('#confirmation_pwd').val();
                if ($pwd != $confirmPwd) {
                    alert("Mật khẩu không khớp, vui lòng kiểm tra lại")
                    return false
                }
                return true
            }
        </script>

        </body>

</html>