<?php

include_once 'app/views/share/header.php';

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
<form class="user" action="/TAMTHAITU/product/save" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <input type="text" class="form-control form-control-user"
            placeholder="Enter Product Name" name="name">
    </div>
    <div class="form-group">
        <input type="text" class="form-control form-control-user"
            placeholder="Product Description" name="description">
    </div>
    <div class="form-group">
        <input type="number" class="form-control form-control-user"
            placeholder="Product Price" name="price"> 
    </div>
    <div class="form-group">
        <input type="file" class="form-control form-control-user"
            placeholder="Product Image" name="image">
    </div>
    <button href="index.html" class="btn btn-facebook btn-user btn-block">
        Save Product
    </button>
</form>

<?php

include_once 'app/views/share/footer.php';

?>