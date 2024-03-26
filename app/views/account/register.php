<?php

include_once 'app/views/share/header.php';
include_once 'app/controllers/AccountController.php';
?>

<!-- Hiển thị danh sách lỗi từ $errors -->

<?php

if(isset($errors)){
    echo "<ul>";
    foreach($errors as $err){
        echo "<li class='text-danger'>$err</li>";
    }
    echo "</ul>";
}

?>

<form class="user" action="/TAMTHAITU/account/register" method="post" enctype="multipart/form-data">
 
    <div class="form-group">
        <input type="text" class="form-control form-control-user"
            placeholder="User Name" name="username" required>
    </div>
    <div class="form-group">
        <input type="password" class="form-control form-control-user"
            placeholder="Password" name="password" required>
    </div>
    <div class="form-group">
        <input type="password" class="form-control form-control-user"
            placeholder="Confirm Password" name="confirm_password" required>
    </div>
    <button  class="btn btn-facebook btn-user btn-block">
        Đăng ký
    </button>
    <a href="/TAMTHAITU/account/login" class="btn btn-facebook btn-user btn-block">
        Đăng nhập
    </a>
</form>

<?php

include_once 'app/views/share/footer.php';

?>