<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BLOG </title>
    <link rel="stylesheet" href="../../asset/css/blog.css"> <!-- Liên kết đến file CSS cho blog -->
</head>
<body>
    <?php
    // Truy vấn cơ sở dữ liệu để lấy bài báo theo id từ URL
    $sql_pro = "SELECT * FROM tbl_baibao WHERE tbl_baibao.id_baibao = '$_GET[id]' AND tinhtrang=1 ORDER BY id_baibao LIMIT 1";
    $query_pro = mysqli_query($mysqli,$sql_pro); // Thực hiện truy vấn SQL
    ?>
    
    <?php
    // Duyệt qua các bài báo và hiển thị thông tin
    while($row_baibao = mysqli_fetch_array($query_pro)){
    ?> 
    <div class="blog"> <!-- Đây là phần hiển thị chi tiết bài viết -->
        <a href="./index.php" class="blog_header"> <!-- Liên kết quay lại trang blog -->
            <div class="blog_header--icon ti-angle-left"></div> <!-- Biểu tượng quay lại -->
            <div>BACK TO BLOG </div> <!-- Văn bản "Quay lại blog" -->
        </a>
        <h1 class="blog_main"><?php echo $row_baibao['tenbaibao'] ?></h1> <!-- Tiêu đề bài viết -->
        <p class="text_center"><?php echo $row_baibao['thoigian'] ?></p> <!-- Hiển thị thời gian bài viết được đăng -->
        <p><?php echo $row_baibao['noidung'] ?></p> <!-- Nội dung bài viết -->
    </div>
    <?php } ?>
    
    <?php
    // Bao gồm phần footer của trang
    include('./pages/footer/footer.php');
    ?>
</body>
</html>
