<?php
$connection = new mysqli('localhost', 'username', 'password', 'database_name');

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$sql = "SELECT * FROM items ORDER BY id DESC";
$result = $connection->query($sql);

$notes = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $notes[] = $row;
    }
}

echo json_encode($notes);

$connection->close();
?>