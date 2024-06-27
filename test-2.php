<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "root";
$password = "root";
$database = "sonnet";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully<br>";

// Insert test data
$item = "Test Item";
$category = "Test Category";
$file_path = "";
$primary = 1;
$ftd = 0;
$hidden = 0;
$user_id = 1; // Replace with an actual user_id from your users table

$sql = "INSERT INTO items (item, category, file_path, `primary`, ftd, hidden, user_id) VALUES ('$item', '$category', '$file_path', $primary, $ftd, $hidden, $user_id)";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>