<?php
include_once 'app/views/share/header.php';

?>

<!-- Hiển thị thông báo lỗi từ $error -->
<?php
    if(isset($error) && !empty($error)){
        echo "<div class='text-danger'>$error</div>";
    }
?>

<form class="user" action="/TAMTHAITU/account/login" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <input type="text" class="form-control form-control-user"
            placeholder="User Name" name="username">
    </div>
    <div class="form-group">
        <input type="password" class="form-control form-control-user"
            placeholder="Password" name="password">
    </div>
   
    <button  class="btn btn-facebook btn-user btn-block">
        Login
    </button>
    <a href="/TAMTHAITU/account/register" class="btn btn-facebook btn-user btn-block">
        Register
</a>
</form>

<?php
include_once 'app/views/share/footer.php';
?>
