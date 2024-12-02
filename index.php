<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <title>ADMIN</title>
</head>

<body>
    <?php
    session_start();
    include('./config/db_config.php');
    if (isset($_SESSION['role_id']) && $_SESSION['role_id']==1) {
        include('./modules/header.php');
        ?>
        <div class="container">
            <aside>
                <div class="toggle">
                    <div class="logo">
                        <img src="img/logo.gif">
                        <h2>TOBI <span class="danger">ADMIN</span></h2>
                    </div>
                </div>

                <div class="main">
                    <div class="sidebar">
                        <?php include('./modules/menu.php'); ?>
                    </div>

                </div>
            </aside>
            <div class="hien_thi">
                <?php
                include('./config/db_config.php');
                include('./modules/main.php');
                ?>
            </div>
        </div>
        </div>
        <?php
    } else {
        echo '<h1 style="display: flex; justify-content: center; align-items: center; height: 100vh; text-align: center; color: red;">Vui lòng đăng nhập! <br><a href="../index.php">Trở lại</a></h1>';
    }
    ?>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script>
        CKEDITOR.replace('thongtinlienhe');
        CKEDITOR.replace('tomtat');
        CKEDITOR.replace('noidung');
    </script>
  
   

</body>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('tomtat');
    CKEDITOR.replace('noidung');
</script>

</html>