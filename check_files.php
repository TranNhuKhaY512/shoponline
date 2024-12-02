<?php
// Định nghĩa đường dẫn gốc
$base_path = './modules/';

// Danh sách các module và file cần kiểm tra
$files_to_check = [
    // Quản lý menu
    'quanlimenu/them.php',
    'quanlimenu/lietke.php',
    'quanlimenu/sua.php',
    
    // Quản lý sản phẩm
    'quanlisanpham/them.php',
    'quanlisanpham/lietke.php',
    'quanlisanpham/sua.php',
    'quanlisanpham/kichthuoc.php',
    
    // Quản lý chính sách
    'quanlichinhsach/them.php',
    'quanlichinhsach/lietke.php',
    'quanlichinhsach/sua.php',
    
    // Quản lý chi nhánh
    'quanlichinhanh/them.php',
    'quanlichinhanh/lietke.php',
    'quanlichinhanh/sua.php',
    
    // Quản lý liên hệ
    'quanlilienhe/them.php',
    'quanlilienhe/lietke.php',
    'quanlilienhe/sua.php',
    
    // Quản lý ảnh bìa
    'quanlianhbia/them.php',
    'quanlianhbia/lietke.php',
    'quanlianhbia/sua.php',
    
    // Quản lý blog
    'quanliblog/them.php',
    'quanliblog/sua.php',
    'quanliblog/lietke.php',
    
    // Quản lý thành viên
    'quanlithanhvien/them.php',
    'quanlithanhvien/sua.php',
    'quanlithanhvien/lietke.php',
    
    // Quản lý kho
    'quanlikho/lietke.php',
];

echo "<h2>Kiểm tra sự tồn tại của files:</h2>";
echo "<pre>";

$missing_files = [];
$existing_files = [];

foreach ($files_to_check as $file) {
    $full_path = $base_path . $file;
    if (file_exists($full_path)) {
        $existing_files[] = $file;
        echo "✅ File tồn tại: {$file}\n";
    } else {
        $missing_files[] = $file;
        echo "❌ File không tồn tại: {$file}\n";
    }
}

echo "\n--- Tổng kết ---\n";
echo "Tổng số file kiểm tra: " . count($files_to_check) . "\n";
echo "Số file tồn tại: " . count($existing_files) . "\n";
echo "Số file thiếu: " . count($missing_files) . "\n";

if (count($missing_files) > 0) {
    echo "\nDanh sách file cần tạo:\n";
    foreach ($missing_files as $file) {
        echo "- {$file}\n";
    }
}

echo "</pre>";
?>