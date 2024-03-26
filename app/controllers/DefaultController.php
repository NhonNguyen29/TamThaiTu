<?php

class DefaultController {
    private $productModel;
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
        $this->productModel = new ProductModel($this->db);
    }

    // public function index() {
    //     if (!isset($_SESSION['username'])) { // Kiểm tra xem session 'username' đã được thiết lập chưa
    //         header('Location: http://localhost/TAMTHAITU/');
    //         exit; // Kết thúc việc xử lý sau khi chuyển hướng
    //     }

    //     $products = $this->productModel->readAll(); // Đọc tất cả sản phẩm từ ProductModel

        
    // }

    function index() {
        $database = new Database();
        $db = $database->getConnection();
    
        // Bắt đầu hoặc tiếp tục session
        //session_start();
    
        // Kiểm tra xem session 'username' đã được thiết lập hay chưa
        if (isset($_SESSION['username'])) {
            // Hiển thị trang index nếu session là true
            $product = new ProductModel($db);
            $products = $product->readAll();
    
            include_once 'app/views/share/index.php';
        } else {
            // Điều hướng đến trang login nếu session là false
            header("Location: /TAMTHAITU/account/login");
            exit;
        }
    }
    
}
