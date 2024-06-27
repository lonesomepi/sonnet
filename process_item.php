<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $item = $_POST['item'];
    $category = $_POST['category'] ?? '';
    $primary = isset($_POST['primary']) ? 1 : 0;
    $ftd = isset($_POST['ftd']) ? 1 : 0;
    $hidden = isset($_POST['hidden']) ? 1 : 0;

    // Handle file upload
    $file_name = $_FILES['item-file']['name'] ?? '';
    $file_tmp = $_FILES['item-file']['tmp_name'] ?? '';
    $upload_dir = 'uploads/';

    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $file_path = '';
    if ($file_name && move_uploaded_file($file_tmp, $upload_dir . basename($file_name))) {
        $file_path = $upload_dir . basename($file_name);
    }

    // Connect to database
    $connection = new mysqli('localhost', 'username', 'password', 'database_name');

    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // Insert form data into database
    $stmt = $connection->prepare("INSERT INTO items (item, category, file_path, primary, ftd, hidden) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssiii", $item, $category, $file_path, $primary, $ftd, $hidden);

    if ($stmt->execute()) {
        echo "Item added successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $connection->close();
}
?>