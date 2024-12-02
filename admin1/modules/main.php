<div>
    <?php
        // Kiểm tra xem tham số 'action' và 'query' có tồn tại trong URL không
        if(isset($_GET['action']) && $_GET['query']){
            $tam = $_GET['action']; // Gán giá trị của 'action' vào biến $tam
            $query = $_GET['query']; // Gán giá trị của 'query' vào biến $query
        } else {
            // Nếu không có tham số 'action' hoặc 'query', gán giá trị mặc định là rỗng
            $tam = ''; 
            $query = ''; 
        }

        // Kiểm tra điều kiện để include các file dựa trên giá trị của 'action' và 'query'
        if($tam=='quanlimenu' && $query=='them'){ // Nếu action là 'quanlimenu' và query là 'them'
            include('quanlimenu/them.php'); 
        } elseif ($tam=='quanlimenu' && $query=='lietke'){   // Nếu action là 'quanlimenu' và query là 'lietke'
            include('quanlimenu/lietke.php'); 
        } elseif ($tam=='quanlimenu' && $query=='sua'){ // Nếu action là 'quanlimenu' và query là 'sua'
            include('quanlimenu/sua.php'); 
        } elseif ($tam=='quanlisanpham' && $query=='them'){ // Nếu action là 'quanlisanpham' và query là 'them'
            include('quanlisanpham/them.php'); 
        } elseif ($tam=='quanlisanpham' && $query=='lietke'){ // Nếu action là 'quanlisanpham' và query là 'lietke'
            include('quanlisanpham/lietke.php'); 
        } elseif ($tam=='quanlisanpham' && $query=='sua'){ // Nếu action là 'quanlisanpham' và query là 'sua'
            include('quanlisanpham/sua.php'); 
        } elseif ($tam=='quanlidonhang' && $query=='lietke'){ // Nếu action là 'quanlidonhang' và query là 'lietke'
            include('quanlidonhang/lietke.php'); 
        } elseif ($tam=='quanlidonhang' && $query=='loc'){ // Nếu action là 'quanlidonhang' và query là 'loc'
            include('quanlidonhang/loc.php'); 
        } elseif ($tam=='quanlidonhang' && $query=='xemdonhang'){ // Nếu action là 'quanlidonhang' và query là 'xemdonhang'
            include('quanlidonhang/xemdonhang.php'); 

        } elseif ($tam=='quanlidonhang' && $query=='xuly'){ // Nếu action là 'quanlidonhang' và query là 'xuly'
            include('quanlidonhang/xuly.php'); 

        } elseif ($tam=='quanlitenchinhsach' && $query=='them'){ // Nếu action là 'quanlitenchinhsach' và query là 'them'
            include('quanlitenchinhsach/them.php'); 
        } elseif ($tam=='quanlitenchinhsach' && $query=='lietke'){ // Nếu action là 'quanlitenchinhsach' và query là 'lietke'
            include('quanlitenchinhsach/lietke.php'); 
        } elseif ($tam=='quanlitenchinhsach' && $query=='sua'){ // Nếu action là 'quanlitenchinhsach' và query là 'sua'
            include('quanlitenchinhsach/sua.php');

        } elseif ($tam=='quanlichinhsach' && $query=='them'){ // Nếu action là 'quanlichinhsach' và query là 'them'
            include('quanlichinhsach/them.php'); 
        } elseif ($tam=='quanlichinhsach' && $query=='lietke'){ // Nếu action là 'quanlichinhsach' và query là 'lietke'
            include('quanlichinhsach/lietke.php'); 
        } elseif ($tam=='quanlichinhsach' && $query=='sua'){ // Nếu action là 'quanlichinhsach' và query là 'sua'
            include('quanlichinhsach/sua.php'); 

        } elseif ($tam=='quanlichinhanh' && $query=='them'){ // Nếu action là 'quanlichinhanh' và query là 'them'
            include('quanlichinhanh/them.php'); 
        } elseif ($tam=='quanlichinhanh' && $query=='lietke'){ // Nếu action là 'quanlichinhanh' và query là 'lietke'
            include('quanlichinhanh/lietke.php'); 
        } elseif ($tam=='quanlichinhanh' && $query=='sua'){ // Nếu action là 'quanlichinhanh' và query là 'sua'
            include('quanlichinhanh/sua.php'); 

        } elseif ($tam=='quanlilienhe' && $query=='them'){ // Nếu action là 'quanlilienhe' và query là 'them'
            include('quanlilienhe/them.php'); 
        } elseif ($tam=='quanlilienhe' && $query=='lietke'){ // Nếu action là 'quanlilienhe' và query là 'lietke'
            include('quanlilienhe/lietke.php'); 
        } elseif ($tam=='quanlilienhe' && $query=='sua'){ // Nếu action là 'quanlilienhe' và query là 'sua'
            include('quanlilienhe/sua.php');

        } elseif ($tam=='quanlianhbia' && $query=='them'){ // Nếu action là 'quanlianhbia' và query là 'them'
            include('quanlianhbia/them.php'); 
        } elseif ($tam=='quanlianhbia' && $query=='lietke'){ // Nếu action là 'quanlianhbia' và query là 'lietke'
            include('quanlianhbia/lietke.php'); 
        } elseif ($tam=='quanlianhbia' && $query=='sua'){ // Nếu action là 'quanlianhbia' và query là 'sua'
            include('quanlianhbia/sua.php'); 

        } elseif ($tam=='quanliblog' && $query=='them'){ // Nếu action là 'quanliblog' và query là 'them'
            include('quanliblog/them.php');
        } elseif ($tam=='quanliblog' && $query=='sua'){ // Nếu action là 'quanliblog' và query là 'sua'
            include('quanliblog/sua.php');
        } elseif ($tam=='quanliblog' && $query=='lietke'){ // Nếu action là 'quanliblog' và query là 'lietke'
            include('quanliblog/lietke.php'); 

        } elseif($tam=='quanlithanhvien' && $query =='lietke'){ // Nếu action là 'quanlithanhvien' và query là 'lietke'
            include('quanlithanhvien/lietke.php'); 
        } elseif($tam=='quanlithanhvien' && $query =='sua'){ // Nếu action là 'quanlithanhvien' và query là 'sua'
            include('quanlithanhvien/sua.php'); 
        } elseif($tam=='quanlithanhvien' && $query =='them'){ // Nếu action là 'quanlithanhvien' và query là 'them'
            include('quanlithanhvien/them.php'); 

        } elseif ($tam=='quanlikho' && $query=='lietke'){ // Nếu action là 'quanlikho' và query là 'lietke'
            include('quanlikho/lietke.php'); 
        }
    ?>
</div>
