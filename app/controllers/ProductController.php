<?php
class ProductController {

    private $productModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->productModel = new ProductModel($this->db);
    }


    // public function create() {
    //     include_once 'app/views/create.php';
    // }

    public function add() {
        include_once 'app/views/product/add.php';
    }

    // public function listProducts() {
    //     $database = new Database();
    //     $db = $database->getConnection();

    //     $product = new ProductModel($db);
    //     $products = $product->readAll();

    //     include_once 'app/views/product_list.php';
    // }

    public function save() {

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            $price = $_POST['price'] ?? '';

            $errors = [];
            if(empty($name)) {
                $errors['name'] = "Tên sản phẩm không được để trống";
            }
            if(empty($description)) {
                $errors['description'] = "Mô tả sản phẩm không được để trống";
            }
            if(!is_numeric($price) || $price < 0) {
                $errors['price'] = "Giá sản phẩm không hợp lệ";
            }
            if(empty($_FILES['image']['size'])) {
                $errors['image'] = "Hình ảnh không hợp lệ!";
            }
            if(count($errors) > 0){
                include_once 'app/views/product/add.php';
            }else{
                // xử lý hình ảnh trước
                $uploadImageResult = $this->uploadImage($_FILES["image"]);
                if($uploadImageResult == false){
                    $errors['image'] = "Lỗi tải hình ảnh lên server!";
                    include_once 'app/views/product/add.php';
                }else{
                    // lưu sản phẩm 
                    $result = $this->productModel->createProduct($name, $description, $price, $uploadImageResult);
                    if($result){
                        // trả về trang danh sách
                        header('Location: /TAMTHAITU');
                    }else{
                        $errors['db'] = "Lỗi lưu sản phẩm vào CSDL!";
                    include_once 'app/views/product/add.php';
                    }
                }
            }
        }
    }

    function edit($id){
        $product = $this->productModel->getProductById($id);

        if($product){
            include_once 'app/views/product/edit.php';
        }else{
            include_once 'app/views/product/not_found.php';
        }
    }

    //phương thức lưu hình ảnh
    public function uploadImage($file) {
        $targetDirectory = "uploads/";
        $targetFile = $targetDirectory . basename($file["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    
        // Kiểm tra xem file có phải là hình ảnh thực sự hay không
        $check = getimagesize($file["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }
    
        // Kiểm tra kích thước file
        if ($file["size"] > 500000) { // Ví dụ: giới hạn 500KB
            $uploadOk = 0;
        }
    
        // Kiểm tra định dạng file
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $uploadOk = 0;
        }
    
        // Kiểm tra nếu $uploadOk bằng 0
        if ($uploadOk == 0) {
            return false;
        } else {
            if (move_uploaded_file($file["tmp_name"], $targetFile)) {
                return $targetFile;
            } else {
                return false;
            }
        }
    }

    // public function save() {
    //     $database = new Database();
    //     $db = $database->getConnection();

    //     $product = new ProductModel($db);

    //     if(isset($_POST['name']) && isset($_POST['description']) && isset($_POST['price'])) {
    //         $name = $_POST['name'];
    //         $description = $_POST['description'];
    //         $price = $_POST['price'];

    //         if($product->createProduct($name, $description, $price)) {
    //             echo "Product created successfully!";
    //         } else {
    //             echo "Failed to create product!";
    //         }
    //     } else {
    //         echo "All fields are required!";
    //     }
    // }

    // public function edit($id) {
    //     $database = new Database();
    //     $db = $database->getConnection();

    //     $product = new ProductModel($db);
    //     $existingProduct = $product->getProductById($id);

    //     if (!$existingProduct) {
    //         echo "Product not found!";
    //         return;
    //     }

    //     include_once 'app/views/edit.php';
    // }

    // public function update() {
    //     $database = new Database();
    //     $db = $database->getConnection();

    //     $product = new ProductModel($db);

    //     if(isset($_POST['id']) && isset($_POST['name']) && isset($_POST['description']) && isset($_POST['price'])) {
    //         $id = $_POST['id'];
    //         $name = $_POST['name'];
    //         $description = $_POST['description'];
    //         $price = $_POST['price'];

    //         if($product->updateProduct($id, $name, $description, $price)) {
    //             echo "Product updated successfully!";
    //         } else {
    //             echo "Failed to update product!";
    //         }
    //     } else {
    //         echo "All fields are required!";
    //     }
    // }

    public function delete() {
        $database = new Database();
        $db = $database->getConnection();

        $product = new ProductModel($db);

        if(isset($_POST['id'])) {
            $id = $_POST['id'];

            if($product->deleteProduct($id)) {
                echo "Product deleted successfully!";
            } else {
                echo "Failed to delete product!";
            }
        } else {
            echo "Product ID is required!";
        }
    }
}
?>
