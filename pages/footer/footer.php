<link rel="stylesheet" href="asset/css/style.css">
<div class="one-footer" > 
    <div class="one">
        <!-- Phần thông tin cửa hàng -->
        <div class="one-1">
            <h4>HỆ THỐNG CỬA HÀNG TOBI</h4>
            <P></P>
            <div class="one12">
                <?php
                    $sql_chinhanh = "SELECT * FROM tbl_chinhanh ORDER BY id_chinhanh ASC";
                    $query_chinhanh = mysqli_query($mysqli, $sql_chinhanh);
                    while ($row_chinhanh = mysqli_fetch_array($query_chinhanh)) {
                        echo "<p>{$row_chinhanh['chinhanh']}</p>";
                    }
                ?>
            </div>
        </div>

        <!-- Phần chính sách -->
        <div class="one-1">
            <h4>CHÍNH SÁCH</h4>
            <P></P>
            <div class="one12">
                <ul class="one13">
                    <?php
                        $sql_tenchinhsach = "SELECT * FROM tbl_tenchinhsach ORDER BY id_tenchinhsach ASC";
                        $query_tenchinhsach = mysqli_query($mysqli, $sql_tenchinhsach);
                        while ($row_tenchinhsach = mysqli_fetch_array($query_tenchinhsach)) {
                            echo "<li><a href='./index.php?quanly=chinhsach&id={$row_tenchinhsach['id_tenchinhsach']}'>{$row_tenchinhsach['tenchinhsach']}</a></li>";
                        }
                    ?>
                </ul>
            </div>
        </div>

        <!-- Phần thông tin liên hệ -->
        <div class="one-1">
            <h4>THÔNG TIN LIÊN HỆ</h4>
            <P></P>
            <div class="one12">
                <?php
                    $sql_lienhe = "SELECT * FROM tbl_lienhe ORDER BY id_lienhe ASC";
                    $query_lienhe = mysqli_query($mysqli, $sql_lienhe);
                    while ($row_lienhe = mysqli_fetch_array($query_lienhe)) {
                        echo "<ul><li>{$row_lienhe['lienhe']}</li></ul>";
                    }
                ?>
            </div>
        </div>

        <!-- Phần mạng xã hội -->
        <div class="one-1">
            <h4>FOLLOW US ON SOCIAL MEDIA</h4>
            <p></p>
            <div class="one-footer">
                <a href="https://www.facebook.com/TobiStreetwear">
                    <img src="https://cdn.icon-icons.com/icons2/790/PNG/512/fb_icon-icons.com_65434.png">
                </a>
                <a href="https://www.instagram.com/tobiclo/">
                    <img src="https://cdn.icon-icons.com/icons2/2518/PNG/512/brand_instagram_icon_151534.png">
                </a>
                <div class="one-footer1"> 
                    <a href="http://online.gov.vn/Home/WebDetails/78935?AspxAutoDetectCookieSupport=1">
                        <img src="http://online.gov.vn/Content/EndUser/LogoCCDVSaleNoti/logoSaleNoti.png">
                    </a>
                </div>
            </div>     
        </div>
    </div>
</div>
