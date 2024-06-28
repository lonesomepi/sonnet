<?php
require_once 'config/database.php';
require_once 'controllers/ItemController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $item = $_POST['item'];
    $category = $_POST['category'];
    $file = $_FILES['file']['name'];
    $tags = implode(",", $_POST['tags']);

    $itemController = new ItemController();
    $result = $itemController->addItem($item, $category, $file, $tags);

    if ($result) {
        echo "Item added successfully";
    } else {
        echo "Failed to add item";
    }
} else {
    echo "Invalid request method.";
}
?>