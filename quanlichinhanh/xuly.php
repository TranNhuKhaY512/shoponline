<?php

    include('../../config/db_config.php'); //truyền dữ liệu về mysql

    //gọi tên danh mục và  thứ tự từ bên trang thêm sang
    $chinhanh = $_POST['chinhanh'];
    $thutu = $_POST['thutu'];
    //bắt đầu truyền về mysq/
    if(isset($_POST['themchinhanh'])){
        //them
        $sql_them = "INSERT INTO tbl_chinhanh(chinhanh,thutu) VALUE('".$chinhanh."','".$thutu."')";
        mysqli_query($mysqli,$sql_them);
        header('location:../../index.php?action=quanlichinhanh&query=them'); //quay lại trang them.php
    }
    elseif(isset($_POST['suachinhanh'])){
        //sua
        $sql_update = "UPDATE tbl_chinhanh SET chinhanh='".$chinhanh."',thutu='".$thutu."' WHERE id_chinhanh='$_GET[idchinhanh]'";
        mysqli_query($mysqli,$sql_update);
        header('location:../../index.php?action=quanlichinhanh&query=lietke'); //quay lại trang lietke.php
    }
    else{
        //xóa
        $id=$_GET['idchinhanh'];
        $sql_xoa = "DELETE FROM tbl_chinhanh WHERE id_chinhanh='".$id."'";
        mysqli_query($mysqli,$sql_xoa);
         header('location:../../index.php?action=quanlichinhanh&query=them');
    }


?>