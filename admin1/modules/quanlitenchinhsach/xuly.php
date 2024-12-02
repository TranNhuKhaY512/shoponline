<?php

    include('../../config/db_config.php'); //truyền dữ liệu về mysql

    //gọi tên danh mục avf thứ tự từ bên trang thêm sang
    $tenchinhsach = $_POST['tenchinhsach'];
    $thutu = $_POST['thutu'];
    //bắt đầu truyền về mysq/
    if(isset($_POST['themtenchinhsach'])){
        //them
        $sql_them = "INSERT INTO tbl_tenchinhsach(tenchinhsach,thutu) VALUE('".$tenchinhsach."','".$thutu."')";
        mysqli_query($mysqli,$sql_them);
        header('location:../../index.php?action=quanlitenchinhsach&query=them'); //quay lại trang them.php
    }
    elseif(isset($_POST['suatenchinhsach'])){
        //sua
        $sql_update = "UPDATE tbl_tenchinhsach SET tenchinhsach='".$tenchinhsach."',thutu='".$thutu."' WHERE id_tenchinhsach='$_GET[idtenchinhsach]'";
        mysqli_query($mysqli,$sql_update);
        header('location:../../index.php?action=quanlitenchinhsach&query=lietke'); //quay lại trang lietke.php
    }
    else{
        //xóa
        $id=$_GET['idtenchinhsach'];
        $sql_xoa = "DELETE FROM tbl_tenchinhsach WHERE id_tenchinhsach='".$id."'";
        mysqli_query($mysqli,$sql_xoa);
         header('location:../../index.php?action=quanlitenchinhsach&query=lietke');
    }


?>