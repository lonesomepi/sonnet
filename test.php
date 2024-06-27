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
echo "Connected successfully";

// Test query
$sql = "SELECT * FROM items LIMIT 1";
$result = $conn->query($sql);

if ($result) {
    if ($result->num_rows > 0) {
        echo "Data retrieved successfully:";
        while ($row = $result->fetch_assoc()) {
            echo " id: " . $row["item_id"]. " - Name: " . $row["item"]. " - Category: " . $row["category"]. "<br>";
        }
    } else {
        echo "No data found";
    }
} else {
    echo "Error executing query: " . $conn->error;
}

$conn->close();
?>