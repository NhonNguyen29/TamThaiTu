<!DOCTYPE html>
<html lang="en">
<head>
  <title>Edit Product</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Edit Product</h2>
  <form action="/TAMTHAITU/product/update" method="post">
    <input type="hidden" name="id" value="<?php echo $existingProduct['id']; ?>">
    <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" class="form-control" id="name" name="name" value="<?php echo $existingProduct['name']; ?>">
    </div>
    <div class="form-group">
      <label for="description">Description:</label>
      <input type="text" class="form-control" id="description" name="description" value="<?php echo $existingProduct['description']; ?>">
    </div>
    <div class="form-group">
      <label for="price">Price:</label>
      <input type="number" class="form-control" id="price" name="price" value="<?php echo $existingProduct['price']; ?>">
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
  </form>
</div>

</body>
</html>
