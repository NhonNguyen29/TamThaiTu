<?php
include_once('/xampp/htdocs/TAMTHAITU/app/models/UserModel.php');
include_once('/xampp/htdocs/TAMTHAITU/config/database.php');
class AccountController
{
    private $conn;


    public function register()
    {
        // Xử lý đăng ký
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];
            
            // Kiểm tra mật khẩu và mật khẩu xác nhận
            if ($password !== $confirmPassword) {
                $errors = ['Mật khẩu và xác nhận mật khẩu không khớp!'];
                include_once 'app/views/account/register.php';
                return;
            }
    
            $database = new Database();
            $db = $database->getConnection(); // Khởi tạo kết nối cơ sở dữ liệu
            $userModel = new UserModel($db); // Truyền kết nối cơ sở dữ liệu vào UserModel
            $role = "user"; 
    
            $result = $userModel->createUser($username, $password, $role);
    
            if ($result) {
                // Lưu thông tin người dùng vào session
                $_SESSION['username'] = $username;
                header("Location: /TAMTHAITU/account/login");
                exit;
            } else {
                $errors = ['Đã có lỗi xảy ra trong quá trình đăng ký. Vui lòng thử lại sau!'];
                include_once 'app/views/account/register.php';
                return;
            }
        }
    
        include_once 'app/views/account/register.php';
    }
    public function dashboard()
    {
        // Kiểm tra người dùng đã đăng nhập chưa
        if (!isset($_SESSION['username'])) {
            header("Location: /TAMTHAITU/s/login");
            exit;
        }

        // Hiển thị trang dashboard
        include_once 'app/index.php';
    }
    private $userModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->userModel = new UserModel($this->db);
    }
    // public function login() {
    //     $error = ''; // Khởi tạo biến lỗi trống
    
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         // Kiểm tra thông tin đăng nhập
    //         $username = $_POST['username'] ?? '';
    //         $password = $_POST['password'] ?? '';
    
    //         $loggedInUser = $this->userModel->login($username, $password);
    //         if ($loggedInUser) {
    //             // Đăng nhập thành công, chuyển hướng đến trang chính
    //             header('Location: http://localhost/TAMTHAITU/');
    //             exit;
    //         } else {
    //             // Đăng nhập không thành công, gán thông báo lỗi
    //             $error = "Tên người dùng hoặc mật khẩu không chính xác.";
    //         }
    //     }
    
    //     // Truyền biến $error sang view login.php
    //     include_once '/xampp/htdocs/TAMTHAITU/app/views/account/login.php';
    // }
    public function login() {
        $error = ''; // Khởi tạo biến lỗi trống
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Kiểm tra thông tin đăng nhập
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            // var_dump($username."---".$password);
            // die();
    
            $loggedInUser = $this->userModel->login($username, $password);
            // var_dump($loggedInUser);
            // die();
            if ($loggedInUser) {
                // Đăng nhập thành công, lưu session và chuyển hướng đến trang chính
                //session_start(); // Bắt đầu hoặc tiếp tục session
                $_SESSION['username'] = $username; // Lưu tên người dùng vào session
    
                header('Location: http://localhost/TAMTHAITU/');
                exit;
            } else {
                // Đăng nhập không thành công, gán thông báo lỗi
                $error = "Tên người dùng hoặc mật khẩu không chính xác.";
            }
        }
    
        // Truyền biến $error sang view login.php
        include_once '/xampp/htdocs/TAMTHAITU/app/views/account/login.php';
    }
    
    
}

?>
