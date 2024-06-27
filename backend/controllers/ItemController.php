<?php
require_once '../config/database.php';

class ItemController {
    private $conn;
    private $table_name = "items";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function addItem($item, $category, $file, $tags) {
        $query = "INSERT INTO " . $this->table_name . " (item, category, file, tags) VALUES (:item, :category, :file, :tags)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':item', $item);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':file', $file);
        $stmt->bindParam(':tags', $tags);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>