<?php
    include("config/db_config.php");
?>

<div class="them_thanh_vien">
    <h3>Thêm Thành Viên</h3>
    <form method="POST" action="./modules/quanlithanhvien/xuly.php">
        <table class='them_menu'>
            <tr>
                <td class="them_menu1">Họ và tên</td>
                <td class="them_menu2"><input type="text" name="tenkhachhang" required placeholder="Họ và tên"></td>
            </tr>
            <tr>
                <td class="them_menu1">Địa chỉ</td>
                <td class="them_menu2"><input type="text" name="diachi" required placeholder="Địa chỉ"></td>
            </tr>
            <tr>
                <td class="them_menu1">Số điện thoại</td>
                <td class="them_menu2"><input type="text" name="dienthoai" required placeholder="Số điện thoại"></td>
            </tr>
            <tr>
                <td class="them_menu1">Email</td>
                <td class="them_menu2"><input type="email" name="email" required placeholder="Email"></td>
            </tr>
            <tr>
                <td class="them_menu1">Mật khẩu</td>
                <td class="them_menu2"><input type="password" name="matkhau" required placeholder="Mật khẩu"></td>
            </tr>
            <tr>
                <td class="them_menu1">Quyền</td>
                <td class="them_menu2">
                    <select name="role_id"class="them_thanh_vien_role">
                        <option value="2">Thành viên</option>
                        <option value="1">Quản trị viên</option>
                    </select>
                </td>
            </tr>
            <tr class="btn_thêm_menu">
                <td colspan ='2'><input type="submit" name='themmember' value='Thêm Thành Viên'></td>
            </tr>
        </table>
    </form>
</div>
