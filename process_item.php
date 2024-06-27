<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $item = $_POST['item'];
    $category = $_POST['category'] ?? '';
    $primary = isset($_POST['primary']) ? 1 : 0;
    $ftd = isset($_POST['ftd']) ? 1 : 0;
    $hidden = isset($_POST['hidden']) ? 1 : 0;
    $user_id = $_POST['user_id'];

    $file_name = $_FILES['item-file']['name'] ?? '';
    $file_tmp = $_FILES['item-file']['tmp_name'] ?? '';
    $upload_dir = 'uploads/';
    $file_path = '';

    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    if ($file_name) {
        $target_file = $upload_dir . basename($file_name);
        if (move_uploaded_file($file_tmp, $target_file)) {
            $file_path = $target_file;
        } else {
            echo json_encode(['status' => 'error', 'message' => 'File upload failed']);
            exit;
        }
    }

    $connection = new mysqli('localhost', 'root', 'root', 'sonnet');

    if ($connection->connect_error) {
        echo json_encode(['status' => 'error', 'message' => 'Database connection failed: ' . $connection->connect_error]);
        exit;
    }

    $stmt = $connection->prepare("INSERT INTO items (item, category, file_path, primary, ftd, hidden, user_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        echo json_encode(['status' => 'error', 'message' => 'Prepare statement failed: ' . $connection->error]);
        exit;
    }
    $stmt->bind_param("sssiiii", $item, $category, $file_path, $primary, $ftd, $hidden, $user_id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Item added successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Execute failed: ' . $stmt->error]);
    }

    $stmt->close();
    $connection->close();
}
?>