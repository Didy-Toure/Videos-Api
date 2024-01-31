<?php
include_once 'include/config.php';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error . "\n");
}


$sql = "SELECT * FROM videos WHERE id = 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    header ('Content-Type: application/json');
    echo json_encode($row, JSON_PRETTY_PRINT);
} else {
    echo "Aucune vidéo trouvée.";
}





?>
