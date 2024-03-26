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
            placeholder="Enter Product Name" name="name" value="<?=$product->name?>">
    </div>
    <div class="form-group">
        <input type="text" class="form-control form-control-user"
            placeholder="Product Description" name="description" value="<?=$product->description?>">
    </div>
    <div class="form-group">
        <input type="number" class="form-control form-control-user"
            placeholder="Product Price" name="price" value="<?=$product->price?>"> 
    </div>

    <?php
    if (!empty($product->image) && file_exists($product->image)) {
        echo "<img src='/TAMTHAITU/" . $product->image . "' alt='' >";
    } else {
        echo "No Image";
    }
    ?>

    <div class="form-group">
        <input type="file" class="form-control form-control-user"
            placeholder="Product Image" name="image" value="<?=$product->image?>">
    </div>
    <button href="index.html" class="btn btn-facebook btn-user btn-block">
        Update Product
    </button>
</form>

<?php

include_once 'app/views/share/footer.php';

?>