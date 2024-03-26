<?php
include_once("/xampp/htdocs/TAMTHAITU/config/database.php");

class UserModel {
    private $conn;
    private $table_name = "users";

    public function __construct($db) {
        $this->conn = $db;
    }

    function readuser() {
        $query = "SELECT * FROM " . $this->table_name;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function login($username, $password) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE username = :username";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_OBJ);
        //var_dump($user);
        //die();
        if ($user && password_verify($password, $user->password)) {
            return $user;
        } else {
            return false;
        }
    }
    public function createUser($username, $password, $role) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);

        $query = "INSERT INTO " . $this->table_name . " (username, password, role) VALUES (:username, :password, :role)";

        $stmt = $this->conn->prepare($query); // Đảm bảo rằng $this->conn đã được khởi tạo đúng cách

        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':role', $role);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    

    public function updateUser($username, $newPassword, $newName, $newRole) {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $query = "UPDATE " . $this->table_name . " SET password = :password, name = :name, role = :role WHERE username = :username";
        $stmt = $this->conn->prepare($query);
    
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':name', $newName);
        $stmt->bindParam(':role', $newRole);
    
        if($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteUser($username) {
        $query = "DELETE FROM " . $this->table_name . " WHERE username = :username";
        $stmt = $this->conn->prepare($query);
    
        $stmt->bindParam(':username', $username);
    
        if($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>
