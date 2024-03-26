<?php
class ProductModel {
    private $conn;
    private $table_name = "products";

    public function __construct($db) {
        $this->conn = $db;
    }

    function readAll() {
        $query = "SELECT * FROM " . $this->table_name;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function createProduct($name, $description, $price, $image) {
        $query = "INSERT INTO " . $this->table_name . " (name, description, price, image) VALUES (:name, :description, :price, :image)";

        $stmt = $this->conn->prepare($query);

        // làm sạch dữ liệu
        $name = htmlspecialchars(strip_tags($name));
        $name = htmlspecialchars(strip_tags($description));
        $name = htmlspecialchars(strip_tags($price));

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':image', $image);

        if($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getProductById($id)
    {
        $query = "SELECT * FROM " . $this->table_name . " where id = $id";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    // public function getProductById($id) {
    //     $query = "SELECT id, name, description, price FROM " . $this->table_name . " WHERE id = :id";

    //     $stmt = $this->conn->prepare($query);
    //     $stmt->bindParam(':id', $id);
    //     $stmt->execute();

    //     return $stmt->fetch(PDO::FETCH_ASSOC);
    // }

    public function updateProduct($id, $name, $description, $price) {
        $query = "UPDATE " . $this->table_name . " SET name = :name, description = :description, price = :price WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);

        if($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteProduct($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);

        if($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>
