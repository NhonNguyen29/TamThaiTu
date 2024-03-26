<!DOCTYPE html>
<html lang="en">
<head>
  <title>Product List</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Product List</h2>
  <a href="/TAMTHAITU/product/create" class="btn btn-primary">Add Product</a>
  <br><br>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Price</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
        while ($row = $products->fetch(PDO::FETCH_ASSOC)) {
          echo "<tr>";
          echo "<td>".$row['id']."</td>";
          echo "<td>".$row['name']."</td>";
          echo "<td>".$row['description']."</td>";
          echo "<td>".$row['price']."</td>";
          echo "<td>
                <a href='/TAMTHAITU/product/edit/".$row['id']."' class='btn btn-warning'>Edit</a>
                <form style='display: inline;' action='/TAMTHAITU/product/delete' method='post'>
                    <input type='hidden' name='id' value='".$row['id']."'>
                    <button type='submit' class='btn btn-danger'>Delete</button>
                </form>
                </td>";
          echo "</tr>";
        }
      ?>
    </tbody>
  </table>
</div>

</body>
</html>
