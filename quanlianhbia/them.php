<div class="quanlymenuchung">
            <h3>Ảnh trang  bìa</h3>
            <table class='thêm_menu'>
                <form method="POST" action="./modules/quanlianhbia/xuly.php" enctype="multipart/form-data" >
                    <tr>
                        <td  class="thêm_menu">Hình ảnh</td>
                        <td class="thêm_menu"><input type="file" name="hinhanh"></td>
                    </tr>
                    <tr>
                        <td class="thêm_menu">Thứ tự</td>
                        <td class="thêm_menu"><input type="number" name="thutu" value="Thứ Tự"></td>
                    </tr>
                    <tr>
                        <td  class="thêm_menu">Tình trạng</td>
                        <td class="thêm_menu">
                            <select name="tinhtrang">
                                <option value="1">Kích hoạt</option>
                                <option value="0">Ẩn</option>
                            </select>
                        </td>
                    </tr>
                    <tr class="btn_thêm_menu">
                        
                        <td colspan ='2' ><input type="submit" name='themanhtrangbia' value='Thêm ảnh trang bìa'></td>
                    </tr>
                </form>
            </table>
</div>